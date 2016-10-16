<?php

class NotesModel {
    public static function addNote($title, $content, $label, $author) {
        $database = DatabaseFactory::getFactory()->getConnectionNotes();

        $notes = $database->selectCollection('notes');

        $document = array(
            "title" => $title,
            "content" => $content,
            "label" => $label,
            "author" => $author,
            "created_at" => (new MongoDB\BSON\UTCDateTime(time()))->toDateTime(),
            "edited_at" => (new MongoDB\BSON\UTCDateTime(time()))->toDateTime()
        );

        if ($notes->insertOne($document)) {
            return true;
        }
        return false;
    }

    public static function editNote() {

    }

    public static function deleteNote() {

    }

    public static function getNotesByUser($id) {
        $database = DatabaseFactory::getFactory()->getConnectionNotes();

        $collection = $database->selectCollection('notes');

        return $collection->find();
    }

    public static function getAllNotes() {
        $database = DatabaseFactory::getFactory()->getConnectionNotes();

        $collection = $database->selectCollection('notes');

        return $collection->find();
    }
}