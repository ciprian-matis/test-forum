<?php
namespace Suggestotron\Controller;

class Votes extends \Suggestotron\Controller {

    public function addAction($id) {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "No topic id specified!";
            exit;
        }
		
        $votes = new \Suggestotron\Model\Votes();
        $votes->addVote($_GET['id']);

        header("Location: /");
    } 

	public function minusAction($id) {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "No topic id specified!";
            exit;
        }
		
        $votes = new \Suggestotron\Model\Votes();
        $votes->minus($_GET['id']);

        header("Location: /");
    }
}