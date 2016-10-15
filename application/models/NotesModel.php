<?php

class NotesModel {
    public static function addNote() {

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