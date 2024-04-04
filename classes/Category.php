<?php

/**
 * Category
 *
 * Groupings for articles
 */
class Category
{
        /**
         * Get all the categories
         *
         * @param object $conn Connection to the database
         *
         * @return array An associative array of all the category records
         */
        public static function getAll($conn)
        {
                $sql = "SELECT *
                FROM category
                ORDER BY name;";

                $results = $conn->query($sql);

                return $results->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Insert a new category with its current property values
         *
         * @param object $conn Connection to the database
         *
         * @return boolean True if the insert was successful, false otherwise
         */
        public static function create($conn, $categoryname)
        {
                $sql = "INSERT INTO category (name)
                    VALUES (:categoryname);";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':categoryname', $categoryname, PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
                $stmt->execute();

                if ($category = $stmt->fetch()) {
                        return $category;
                } else {
                        return false;
                }
        }

        /**
         * Find a category by its ID
         *
         * @param object $conn Connection to the database
         * @param int $id The category ID
         *
         * @return mixed An associative array of the category record if found, false otherwise
         */
        public static function getByID($conn, $id)
        {
                $sql = "SELECT *
                    FROM category
                    WHERE id = :id;";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Delete the current category
         *
         * @param object $conn Connection to the database
         *
         * @return boolean True if the delete was successful, false otherwise
         */
        public static function delete($conn, $id)
        {
                $sql = "DELETE FROM category
                WHERE id = :id";

                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                return $stmt->execute();
        }

        /**
         * Update the current category
         *
         * @param object $conn Connection to the database
         * @param string $name The new name of the category
         * @param int $id The category ID
         * @return boolean True if the update was successful, false otherwise
         */
        public static function update($conn, $name, $id)
        {
            $sql = "UPDATE category
                    SET name = :name
                    WHERE id = :id";
        
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
        
}
