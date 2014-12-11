<?php
namespace Suggestotron\Controller;
	
class Topics extends \Suggestotron\Controller {
	protected $data;
	protected $template;
	protected $config;

	public function __construct()
	{
		parent::__construct();
        $this->data = new \Suggestotron\Model\Topics();
	}

    public function listAction() {
		$topics = $this->data->getAllTopics();
		
		// if (isset($_GET['succes'])) {
			// echo '<script>alert("Topic Saved / Modified")</script>';
		// }
		
		$this->template->render("/views/index/list.phtml", ['topics' => $topics]);
    }

    public function addAction() {
		if (isset($_POST) && sizeof($_POST) > 0) {
			$this->data->add($_POST);
			header("Location: /?succes=yes");
			exit;
		}

		$this->template->render("/views/index/add.phtml");
    }

    public function editAction() {
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			if ($this->data->update($_POST)) {
				header("Location: /?succes=yes");
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
	
	protected function render($template, $data = array())
	{
		$config = \Suggestotron\Config::get('site');
		$this->template->render($config['view_path'] . "/" . $template, $data);
	}
}
?>