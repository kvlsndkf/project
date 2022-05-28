<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Course
{
    //attributes
    public int $id;
    public string $name;
    public string $photo;
    public string $about;
    public string $createdAt;
    public string $updatedAt;
    public array $teacher;
    public array $school;
    public array $subject;

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
    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    //----------------------------
    public function getAbout()
    {
        return $this->about;
    }
    public function setAbout($about)
    {
        $this->about = $about;
    }
    //----------------------------
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    //----------------------------
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    //----------------------------
    public function getTeacher()
    {
        return $this->teacher;
    }
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }
    //----------------------------
    public function getSchool()
    {
        return $this->school;
    }
    public function setSchool($school)
    {
        $this->school = $school;
    }
    //----------------------------
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    //----------------------------
    public function getResultBuildList(): array
    {
        return $this->resultBuildList;
    }
    public function setResultBuildList(array $resultBuildList): void
    {
        $this->resultBuildList = $resultBuildList;
    }
    //----------------------------
    //methods

    /**
     * @method registerCourse() register the course by 
     * @param Course $course
     * @param int $id
     */
    public function registerCourse(Course $course)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("INSERT INTO courses(name, about, photo, created_at)
                                         VALUES (?, ?, ?, NOW())");

            $stmt->bindValue(1, $course->getName());
            $stmt->bindValue(2, $course->getAbout());
            $stmt->bindValue(3, $course->getPhoto());

            $stmt->execute();
            $idCourse = $connection->lastInsertId();
            $this->setId($idCourse);
            $connection->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $teacher = $this->getTeacher();
            $school = $this->getSchool();
            $subject = $this->getSubject();
            $idCourse = $this->getId();

            if (!empty($teacher)) {
                for ($i = 0; $i < count($teacher); $i++) {
                    if (!empty($idCourse)) {
                        $registerTeacher = $connection->prepare("INSERT INTO coursesHasTeachers(created_at, course_id, teacher_id)
                                                    VALUES (NOW(), ?, ?)");

                        $registerTeacher->bindValue(1, $idCourse);
                        $registerTeacher->bindValue(2, $teacher[$i]);

                        $registerTeacher->execute();
                    }
                }
            }

            if (!empty($school)) {
                for ($i = 0; $i < count($school); $i++) {
                    if (!empty($idCourse)) {
                        $registerSchool = $connection->prepare("INSERT INTO schoolsHasCourses(created_at, school_id, course_id)
                                                    VALUES (NOW(), ?, ?)");

                        $registerSchool->bindValue(1, $school[$i]);
                        $registerSchool->bindValue(2, $idCourse);

                        $registerSchool->execute();
                    }
                }
            }

            if (!empty($subject)) {
                for ($i = 0; $i < count($subject); $i++) {
                    if (!empty($idCourse)) {
                        $registerSubject = $connection->prepare("INSERT INTO coursesHasSubjects(created_at, course_id, subject_id)
                                                    VALUES (NOW(), ?, ?)");

                        $registerSubject->bindValue(1, $idCourse);
                        $registerSubject->bindValue(2, $subject[$i]);

                        $registerSubject->execute();
                    }
                }
            }

            $_SESSION['statusPositive'] = "Curso cadastrado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-course/list-course.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @method listCourse() lists the courses by 
     * @param string $search 
     */
    public function listCourse(string $search = ''): array | false
    {
        $connection = Connection::connection();

        try {
            if (!is_null($search) && !empty($search)) {
                $result = $this->searchCourse($search);
                return $this->buildCourseList($result);
            }

            $stmt = $connection->prepare("SELECT * FROM courses ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildCourseList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    //----------------------------
    /**
     * @method listSchoolForModal() list the school inside the modal by 
     * @param int $id 
     */
    public function listCourseForModal(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM courses WHERE id='$id'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildCourseList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method buildCourseList() organize the list of teachers by 
     * @param array $result 
     */
    private function buildCourseList(array | false $result)
    {
        $courses = [];

        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            $course = new Course();
            $course->id = $row['id'];
            $course->name = $row['name'];
            $course->photo = $row['photo'];
            $course->photo = $row['photo'];
            $course->about = $row['about'];

            array_push($courses, $course);
        }

        $this->setResultBuildList($courses);
        return $courses;
    }
    //----------------------------
    /**
     * @method countCourses() count the teachers by 
     * @param string $search 
     */
    public function countCourses(string $search = '')
    {
        $searching = (!is_null($search) && !empty($search));

        if ($searching) {
            $resultBuildList = $this->getResultBuildList();
            $totalSearch = count($resultBuildList);
            return "Resultado da pesquisa " . $totalSearch;
        }

        $connection = Connection::connection();
        try {
            $stmt = $connection->prepare("SELECT COUNT(id) AS total FROM courses");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return "Total " . $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method countTeachersInSchool() counts the teachers to appear inside the card chips by 
     * @param int $id 
     */
    public function countTeachersInCourse(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(teacher_id) AS total FROM coursesHasTeachers WHERE course_id='$id'");

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    //----------------------------
    /**
     * @method countTeachersInSchool() counts the teachers to appear inside the card chips by 
     * @param int $id 
     */
    public function countSchoolsInCourse(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(school_id) AS total FROM schoolsHasCourses WHERE course_id='$id'");

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method countTeachersInSchool() counts the teachers to appear inside the card chips by 
     * @param int $id 
     */
    public function countSubjectsInCourse(int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT COUNT(subject_id) AS total FROM coursesHasSubjects WHERE course_id='$id'");

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method deleteSchool() delete the school by 
     * @param int $id 
     * @param string $path 
     */
    public function deleteCourse(int $id, string $path)
    {
        $connection = Connection::connection();

        try {
            unlink("/xampp/htdocs" . $path);

            $stmt = $connection->prepare("DELETE FROM courses WHERE id='$id'");

            $stmt->execute();

            $_SESSION['statusPositive'] = "Curso apagado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-course/list-course.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchSchoolForUpdate() looks for the school data for the update, they appear inside the input by 
     * @param int $id 
     */
    public function searchCourseForUpdate(int $id): array
    {

        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM courses WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectSchoolsUsedByCourse(int $id): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT s.id, s.name, s.photo FROM schoolsHasCourses sc
                                         INNER JOIN schools s
                                         ON s.id = sc.school_id
                                         WHERE sc.course_id = $id
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectAvailableTeachersForSchool() selects teachers that are not being used by the school by 
     * @param int $idSchool
     */
    public function selectAvailableSchoolsForCourse(int $idCourse): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT DISTINCT s.id, s.name FROM schools s
                                        WHERE s.id 
                                        NOT IN ( 
                                        SELECT s.id FROM schoolsHasCourses sc
                                        INNER JOIN schools s
                                        ON s.id = sc.school_id
                                        WHERE sc.course_id = $idCourse)
                                        ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectTeachersUsedByCourse(int $id): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT t.id, t.name, t.photo FROM courseshasteachers st
                                         INNER JOIN teachers t
                                         ON t.id = st.teacher_id
                                         WHERE st.course_id = $id
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectAvailableTeachersForSchool() selects teachers that are not being used by the school by 
     * @param int $idSchool
     */
    public function selectAvailableTeachersForCourse(int $idCourse): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT DISTINCT t.id, t.name FROM teachers t
                                        WHERE t.id 
                                        NOT IN ( 
                                        SELECT t.id FROM courseshasteachers st
                                        INNER JOIN teachers t
                                        ON t.id = st.teacher_id
                                        WHERE st.course_id = $idCourse)
                                        ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectSubjectsUsedByCourse(int $id): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT s.id, s.name FROM courseshassubjects cs
                                         INNER JOIN subjects s
                                         ON s.id = cs.subject_id
                                         WHERE cs.course_id = $id
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method selectAvailableTeachersForSchool() selects teachers that are not being used by the school by 
     * @param int $idSchool
     */
    public function selectAvailableSubjectsForCourse(int $idCourse): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT DISTINCT s.id, s.name FROM subjects s
                                        WHERE s.id 
                                        NOT IN ( 
                                        SELECT s.id FROM courseshassubjects cs
                                        INNER JOIN subjects s
                                        ON s.id = cs.subject_id
                                        WHERE cs.course_id = $idCourse)
                                        ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method updateSchool() updates the school by 
     * @param School $school 
     * @param int $id 
     */
    public function updateCourse(Course $course, int $id)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("UPDATE courses SET name = ?, about = ?, photo = ?, updated_at = NOW()
                                         WHERE id = $id");

            $stmt->bindValue(1, $course->getName());
            $stmt->bindValue(2, $course->getAbout());
            $stmt->bindValue(3, $course->getPhoto());

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        try {
            $teachers = $this->getTeacher();
            $schools = $this->getSchool();
            $subjects = $this->getSubject();

            if (!empty($teachers)) {

                $courseHasTeachersQuery = $connection->prepare(
                    "SELECT ct.teacher_id FROM coursesHasTeachers ct
                     LEFT JOIN teachers t
                     ON ct.teacher_id = t.id
                     WHERE course_id = $id"
                );

                $courseHasTeachersQuery->execute();

                $fetchTeachers = $courseHasTeachersQuery->fetchAll(PDO::FETCH_ASSOC);

                $arrayQuery = array_map(function ($item) {
                    return $item['teacher_id'];
                }, $fetchTeachers);

                $arrayToDelete = array_diff($arrayQuery, $teachers);
                $arrayToInsert = array_diff($teachers, $arrayQuery);

                if (count($arrayToDelete) > 0) {
                    $idTeacherToDelete = [];

                    foreach ($arrayToDelete as $row => $value) {
                        array_push($idTeacherToDelete, $value);
                    }

                    $deleteTeacher = $connection->prepare("DELETE FROM coursesHasTeachers WHERE teacher_id IN (" . implode(', ', $idTeacherToDelete) . ") AND course_id='$id'");
                    $deleteTeacher->execute();
                }

                if (count($arrayToInsert) > 0) {
                    $queryValues = [];
                    $idTeacherToInsert = [];

                    foreach ($arrayToInsert as $row => $value) {
                        array_push($queryValues, '(NOW(), ?, ?)');
                        array_push($idTeacherToInsert, $value);
                    }

                    $insertTeacher = $connection->prepare(
                        "INSERT INTO coursesHasTeachers(created_at, course_id, teacher_id) 
                            VALUES " . implode(', ', $queryValues)
                    );

                    $idCoursePosition = 1;
                    $idTeacherPosition = 2;

                    for ($i = 0; $i < count($arrayToInsert); $i++) {
                        $insertTeacher->bindValue($idCoursePosition, $id);
                        $insertTeacher->bindValue($idTeacherPosition, $idTeacherToInsert[$i]);

                        $idCoursePosition += 2;
                        $idTeacherPosition += 2;
                    }

                    $insertTeacher->execute();
                }
            }

            if (!empty($schools)) {
                $courseHasSchoolsQuery = $connection->prepare(
                    "SELECT sc.school_id FROM schoolsHasCourses sc
                 LEFT JOIN schools s
                 ON sc.school_id = s.id
                 WHERE course_id = $id"
                );

                $courseHasSchoolsQuery->execute();

                $fetchSchools = $courseHasSchoolsQuery->fetchAll(PDO::FETCH_ASSOC);

                $arrayQuery = array_map(function ($item) {
                    return $item['school_id'];
                }, $fetchSchools);

                $arrayToDelete = array_diff($arrayQuery, $schools);
                $arrayToInsert = array_diff($schools, $arrayQuery);

                if (count($arrayToDelete) > 0) {
                    $idSchoolToDelete = [];

                    foreach ($arrayToDelete as $row => $value) {
                        array_push($idSchoolToDelete, $value);
                    }

                    $deleteSchool = $connection->prepare("DELETE FROM schoolsHasCourses WHERE school_id IN (" . implode(', ', $idSchoolToDelete) . ") AND course_id='$id'");
                    $deleteSchool->execute();
                }

                if (count($arrayToInsert) > 0) {
                    $queryValues = [];
                    $idSchoolToInsert = [];

                    foreach ($arrayToInsert as $row => $value) {
                        array_push($queryValues, '(NOW(), ?, ?)');
                        array_push($idSchoolToInsert, $value);
                    }

                    $insertSchool = $connection->prepare(
                        "INSERT INTO schoolsHasCourses(created_at, school_id, course_id) 
                        VALUES " . implode(', ', $queryValues)
                    );

                    $idSchoolPosition = 1;
                    $idCoursePosition = 2;

                    for ($i = 0; $i < count($arrayToInsert); $i++) {
                        $insertSchool->bindValue($idSchoolPosition, $idSchoolToInsert[$i]);
                        $insertSchool->bindValue($idCoursePosition, $id);

                        $idCoursePosition += 2;
                        $idSchoolPosition += 2;
                    }

                    $insertSchool->execute();
                }
            }

            if (!empty($subjects)) {
                $courseHasSubjectsQuery = $connection->prepare(
                    "SELECT cs.subject_id FROM coursesHasSubjects cs
                     LEFT JOIN subjects s
                     ON cs.subject_id = s.id
                     WHERE course_id = $id"
                );

                $courseHasSubjectsQuery->execute();

                $fetchSubjects = $courseHasSubjectsQuery->fetchAll(PDO::FETCH_ASSOC);

                $arrayQuery = array_map(function ($item) {
                    return $item['subject_id'];
                }, $fetchSubjects);

                $arrayToDelete = array_diff($arrayQuery, $subjects);
                $arrayToInsert = array_diff($subjects, $arrayQuery);

                if (count($arrayToDelete) > 0) {
                    $idSubjectToDelete = [];

                    foreach ($arrayToDelete as $row => $value) {
                        array_push($idSubjectToDelete, $value);
                    }

                    $deleteSubject = $connection->prepare("DELETE FROM coursesHasSubjects WHERE subject_id IN (" . implode(', ', $idSubjectToDelete) . ") AND course_id='$id'");
                    $deleteSubject->execute();
                }

                if (count($arrayToInsert) > 0) {
                    $queryValues = [];
                    $idSubjectToInsert = [];

                    foreach ($arrayToInsert as $row => $value) {
                        array_push($queryValues, '(NOW(), ?, ?)');
                        array_push($idSubjectToInsert, $value);
                    }

                    $insertSubject = $connection->prepare(
                        "INSERT INTO coursesHasSubjects(created_at, course_id, subject_id) 
                            VALUES " . implode(', ', $queryValues)
                    );

                    $idCoursePosition = 1;
                    $idSubjectPosition = 2;

                    for ($i = 0; $i < count($arrayToInsert); $i++) {
                        $insertSubject->bindValue($idCoursePosition, $id);
                        $insertSubject->bindValue($idSubjectPosition, $idSubjectToInsert[$i]);

                        $idCoursePosition += 2;
                        $idSubjectPosition += 2;
                    }

                    $insertSubject->execute();
                }
            }

            $_SESSION['statusPositive'] = "Curso atualizado com sucesso.";
            header('Location: /project/private/adm/pages/register/register-course/list-course.page.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method searchSchool() search schools by 
     * @param string $search 
     */
    private function searchCourse(string $search)
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM courses WHERE name LIKE '%$search%' ORDER BY name");

            $stmt->execute();

            $lines = $stmt->rowCount();

            if ($lines == 00) {
                $_SESSION['statusNegative'] = "Não existe registros.";
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method listSchoolOfSearchBar() list schools for search bar  
     */
    public function listCoursesOfSearchBar()
    {
        $connection = Connection::connection();

        try {
            $stmt = $connection->prepare("SELECT * FROM courses ORDER BY name");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->buildCourseList($result);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //----------------------------
    /**
     * @method selectTeachersUsedBySchool() selects the teachers being used by the school by 
     * @param int $id 
     */
    public function selectCoursesUsedBySchool(string $name): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT c.id, c.name, c.photo FROM schoolsHasCourses sc
                                         INNER JOIN courses c
                                         ON c.id = sc.course_id
                                         INNER JOIN schools s
                                         ON s.id = sc.school_id
                                         WHERE s.name = '$name'
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    //----------------------------
    /**
     * @method filteredCourseSelect() filters all courses except the parameter 
     * @param string $name 
     */
    public function filteredCourseSelect(string $name): array
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT * FROM courses
                                         WHERE NOT name = '$name'
                                     ");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->buildCourseList($result);
    }

    //----------------------------
    /**
     * @method getIdCourseByName() find the course by name 
     * @param string $name 
     */
    public function getIdCourseByName($name)
    {
        $connection = Connection::connection();

        $stmt = $connection->prepare("SELECT id FROM courses
                                         WHERE name = '$name'
                                     ");

        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result[0]['id'];
    }
}
