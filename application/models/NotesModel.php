<?php

class NotesModel {
    public static function addNote() {

    }

    public static function editNote() {

    }

    public static function deleteNote() {

    }

    public static function getAllNotes($id) {
        $database = DatabaseFactory::getFactory()->getConnectionNotes();

        $collection = $database->selectCollection('notes');

        return $collection->find();
    }
}