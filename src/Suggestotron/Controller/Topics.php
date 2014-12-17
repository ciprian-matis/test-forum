<?php
namespace Suggestotron\Controller;
	
class Topics extends \Suggestotron\Controller {
	protected $data;
	protected $template;
	protected $config;

	public function __construct() {
		parent::__construct();
        $this->data = new \Suggestotron\Model\Topics();
		session_start();
	}

    public function listAction() {

		$topics = $this->data->getAllTopics();
		
		$data = array();
		$i=0;
		foreach($topics as $topic) {
		
			$data[$i]['id'] = $topic['id'];
			$data[$i]['title'] = $topic['title'];
			$data[$i]['description'] = $topic['description'];
			$data[$i]['count'] = $topic['count'];
			$data[$i]['down'] = $topic['down'];

			$comments = $this->data->getAllComments($topic['id'], 0);
			$comm_array = array();

			foreach ($comments as $comm){
				$comm_array[] = array(
				'id'			=> $comm['id'], 
				'id_topic'		=> $comm['id_topic'], 
				'id_comment'	=> $comm['id_comment'], 
				'content'		=> $comm['content'], 
				'author'		=> $comm['author'], 
				'date'			=> $comm['date']
				);
			}
						
			$tree = $this->buildTree($comm_array, 0);

			$data[$i]['comments'] = $tree;
			
			$i++;
		}
		

		$this->template->render("/views/index/list.phtml", ['topics' => $data]);
    }
	
	function buildTree($elements, $id) {
		
		$branch = array();
		$eliminare = array();
				
		foreach ($elements as $element) {
		// echo $element['id'] . '</br>';
			if ($element['id_comment'] == $id )  {

				$eliminare[] = $element; 
				
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				
				$branch[] = $element;
				unset($elements[key($elements)]);
			}
			// unset($elements[key($elements)]);
			
		}

	
	return $branch;
	}
	
    public function addAction() {
		if (isset($_POST) && sizeof($_POST) > 0) {
			$count = $this->data->add($_POST);
			
			if ($count ==0){
				$this->template->render("views/errors/index.phtml", ['message' => 'Eroare la accesare bazei de date']);
				exit;
			} else { 
				$_SESSION['success'] = 'yes';
				header("Location: /");
				exit;
			}
		}

		$this->template->render("/views/index/add.phtml");
    }

    public function editAction() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			if ($this->data->update($_POST)) {
				$_SESSION['success'] = 'yes';
				header("Location: /");
				exit;
			} else {
				// echo "An error occurred";
				$this->template->render("views/errors/index.phtml", ['message' => 'An error occurred']);
			}
		}

		if (!isset($_GET['id']) || empty($_GET['id'])) {
			// echo "You did not pass in an ID.";
			$this->template->render("views/errors/index.phtml", ['message' => 'You did not pass in an ID.']);
			exit;
		}

		$topic = $this->data->getTopic($_GET['id']);

		if ($topic === false) {
			echo "Topic not found!";
			exit;
		}
		$this->template->render("views/index/edit.phtml", ['topic' => $topic]);
    }

    public function deleteAction() {
		if (!isset($_GET['id']) || empty($_GET['id'])) {
			// echo "You did not pass in an ID.";
			$this->template->render("views/errors/index.phtml", ['message' => 'You did not pass in an ID.']);
			exit;
		}

		$topic = $this->data->getTopic($_GET['id']);

		if ($topic === false) {
			echo "Topic not found!";
			exit;
		}

		if ($this->data->delete($_GET['id'])) {
			header("Location: /");
			exit;
		} else {
			echo "An error occurred";
		}
    }
	
	public function aboutAction() {
		$this->template->render("/views/index/about.phtml");
	}

	public function addCommentAction() {
		$topic = $this->data->getTopic($_GET['id']);
		$this->template->render("/views/index/addComment.phtml", ['topic' => $topic]);
	}
	
	public function addCommenttoDBAction() {
	
		// echo '<pre>'.print_r($_POST, TRUE).'</pre>';
		// exit();
		
		if (isset($_POST) && sizeof($_POST) > 0) {
		
			if (!empty($_POST['name']) && !empty($_POST['comment'])) {
			
				$count = $this->data->addComment($_POST, $_POST['id_comment']);
				
				if ($count ==0 ){
					$this->template->render("views/errors/index.phtml", ['message' => 'Eroare la accesare bazei de date']);
					exit;
				} else { 
					$_SESSION['comment'] = 'yes';
					header("Location: /");
					exit;
				}
			}
		}
	}

	public function addReplyAction() {

		$topic = $this->data->getTopic($_GET['id']);
		$topic['comment'] = $this->data->getComment($_GET['id'],$_GET['commentid']);
		$this->template->render("/views/index/addReply.phtml", ['topic' => $topic]);
	}
	
	public function addReplytoDBAction() {
	
		if (isset($_POST) && sizeof($_POST) > 0) {
		
			if (!empty($_POST['name']) && !empty($_POST['comment'])) {
			
				$count = $this->data->addComment($_POST, $_POST['id_comment']);

				if ($count ==0 ){
					$this->template->render("views/errors/index.phtml", ['message' => 'Eroare la accesare bazei de date']);
					exit;
				} else { 
					header("Location: /?comment=yes");
					exit;
				}
			} else {
				$this->addCommentAction();
			}
		}
	}

	protected function render($template, $data = array()) {
		$config = \Suggestotron\Config::get('site');
		$this->template->render($config['view_path'] . "/" . $template, $data);
	}
}
?>