<?php
class FormEntity
{
    protected $id;
    protected $name;
    protected $data;
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->name = $data['name'];
        $this->data = $data['data'];
    }
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->name;
    }
    public function getFields() {
        return $this->data;
    }
}
