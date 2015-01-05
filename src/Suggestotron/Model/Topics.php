<?php
namespace Suggestotron\Model;

class Topics {
   	
	public function getAllTopics() {
		$sql = "SELECT distinct topics . * , votes.count, votes.down
				FROM topics
				INNER JOIN votes ON votes.topic_id = topics.id
				ORDER BY votes.count DESC, topics.title ASC";

		$query = \Suggestotron\Db::getInstance()->prepare($sql);
		$query->execute();
		
		return $query;
	}
	
	public function getAllComments($id) {
		$sql = "SELECT * FROM comments2 WHERE id_topic = " . $id . " ORDER BY id_comment";

		$query = \Suggestotron\Db::getInstance()->prepare($sql);
		$query->execute();
		
		return $query;
	}
	
	public function add($data) {
		$query = \Suggestotron\Db::getInstance()->prepare(
			"INSERT INTO topics (
					title,
					description
			) VALUES (
					:title,
					:description
			)"
		);

		$data = [
			':title' => $data['title'],
			':description' => $data['description']
		];

		$query->execute($data);
		$count = $query->rowCount();
		
		if ($count == 0) {
			return $count;
		}
		

		// Grab the newly created topic ID
		$id = \Suggestotron\Db::getInstance()->lastInsertId();

		// Add empty vote row
		$sql = "INSERT INTO votes (
					topic_id,
					count
				) VALUES (
					:id,
					0
				)";

		$data = [
			':id' => $id
		];

		$query = \Suggestotron\Db::getInstance()->prepare($sql);
		return $query->execute($data);
		
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
	
	public function delete($id) {
	   $query = \Suggestotron\Db::getInstance()->prepare(
		   "DELETE FROM topics
			   WHERE
				   id = :id"
	   );

	   $data = [
		   ':id' => $id,
	   ];

	   $result = $query->execute($data);

	   if (!$result) {
		   return false;
	   }

	   $sql = "DELETE FROM votes WHERE topic_id = :id";
	   $query = \Suggestotron\Db::getInstance()->prepare($sql);

	   return $query->execute($data);
	}

	public function addComment($data, $id_post_comment) {
		
		$query = \Suggestotron\Db::getInstance()->prepare(
			"INSERT INTO comments2 (
					id,
					id_topic,
					id_comment,
					content,
					author,
					date
			) VALUES (
					:id,
					:id_topic,
					:id_comment,
					:content,
					:author,
					:date
			)"
		);

		$data = [
			':id' 			=> NULL,
			':id_topic'		=> $data['id_topic'],
			':id_comment'	=> $id_post_comment,
			':content' 		=> $data['comment'],
			':author'		=> $data['name'],
			':date'			=> date("Y-m-d")
		];

		$query->execute($data);
		$count = $query->rowCount();
		return $count;
	}

	public function getComment($id, $commentId) {
		
		$sql = "SELECT * FROM comments WHERE id=:id and id_comment=:id_comment";
		$query = \Suggestotron\Db::getInstance()->prepare($sql);
		
		$values = [
			':id' 			=> $id,
			':id_comment'	=> $commentId,
			];
		$query->execute($values);
		
		return $query->fetch(\PDO::FETCH_ASSOC);
	}
	
}
?>