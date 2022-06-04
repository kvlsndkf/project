<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Category
{
    //attributes
    public int $id;
    public string $name;

    //getters and setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    //----------------------------
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    //----------------------------
    //methods

    /**
     * @method listCourse() lists the courses by 
     * @param string $search 
     */
    public function listCategory(): array | false
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM categories ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildCategoryList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildCourseList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildCategoryList(array | false $result)
    {
        $categories = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $category = new Category();
            $category->id = $row['id'];
            $category->name = $row['name'];

            array_push($categories, $category);
        }

        return $categories;
    }
}
