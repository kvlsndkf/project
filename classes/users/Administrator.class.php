<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');
require_once('/xampp/htdocs' . '/project/classes/inheritances/User.class.php');

class Administrator extends User
{
    public function registerAdministrator(Administrator $administrator)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO users(email, password, type_user, is_confirmed, created_at)
                                             VALUES (?, ?, ?, ?, NOW())");
            $stmt->bindValue(1, $administrator->getEmail());
            $stmt->bindValue(2, $administrator->getPassword());
            $stmt->bindValue(3, $administrator->getTypeUser());
            $stmt->bindValue(4, $administrator->getIsConfirmed());

            $stmt->execute();

            $_SESSION['statusPositive'] = "Administrador cadastrado com sucesso.";
            return header('Location: /project/views/pages/login/login-page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
