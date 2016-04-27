<?php
class FormsMapper extends Mapper
{

    public function getForms() {
        $sql = "SELECT *
            from forms m";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
          //$results[] = new MessageEntity($row);
          $results[] = $row;
        }
        return $results;
    }

    /**
     * Get one ticket by its ID
     *
     * @param int $form_id The ID of the ticket
     * @return FormEntity  The ticket
     */
    public function getFormById($form_id) {
      $sql = "SELECT * FROM forms t WHERE id=:form_id";
      try {
              $dbCon = $this->db;
              $stmt = $dbCon->prepare($sql);
              $stmt->bindParam("form_id", $form_id);
              $stmt->execute();
              $form = $stmt->fetchObject();
              $dbCon = null;
              return json_encode(json_decode($form->data));
          } catch(PDOException $e) {
              return '{"error":{"text":'. $e->getMessage() .'}}';
          }

        // $stmt = $this->db->prepare($sql);
        // $result = $stmt->execute(["form_id" => $form_id]);
        // if($result) {
        //     return new FormEntity($stmt->fetch());
        // }
    }

    public function addSubmission($form_id, $paramData) {

      $sql = "INSERT INTO submissions (`form_id`,`data`,`ip`) VALUES (:form_id, :data, :ip)";
      try {
          $dbCon = $this->db;
          $stmt = $dbCon->prepare($sql);
          $stmt->bindParam("form_id", $form_id);
          $stmt->bindParam("data", $paramData);
          $stmt->bindParam("ip", $_SERVER['REMOTE_ADDR']);
          $stmt->execute();
          $dbCon = null;
          return '{"success":{"datasaved":'. $paramData .'}}';
      } catch(PDOException $e) {
          return '{"error":{"text":'. $e->getMessage() .'}}';
      }
  }
}
