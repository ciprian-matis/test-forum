<?php
namespace Suggestotron;

class TopicData {
   
	
	public function getAllTopics() {
        $query = \Suggestotron\Db::getInstance()->prepare("SELECT * FROM topics");
        $query->execute();

        return $query;
    }
	
	public function add($data) {
		$query = $this->connection->prepare(
			"INSERT INTO topics (
				title,
				description
				)
				VALUES
				(
					:title,
					:description
				)"
			);
		$query->execute($data);
	}
	
	public function getTopic($id) {
		$sql = "SELECT * FROM topics WHERE id=:id LIMIT 1";
		$query = \Suggestotron\Db::getInstance()->prepare($sql);
		
		$values = [':id' => $id];
		$query->execute($values);
		
		return $query->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function update($data) {
		$query = \Suggestotron\Db::getInstance()->prepare(
			"UPDATE topics SET
				title = :title,
				description = :description
			WHERE
				id = :id"
		);
		$data = [
			':id' 			=> $data['id'],
			':title' 		=> $data['title'],
			':description' 	=> $data['description']
		];
		
		return $query->execute($data);
	}
	
	public function delete($id){
		$query = $this->connection->prepare(
			"DELETE FROM topics
			WHERE
				id = :id"
		);
		$data = [
			':id' => $id,
		];
		
		return $query->execute($data);
	}
	
}
?>