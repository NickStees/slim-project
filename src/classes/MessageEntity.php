<?php
class MessageEntity
{
    protected $id;
    protected $title;
    protected $body;
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
        $this->title = $data['title'];
        $this->body = $data['body'];
    }
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getDescription() {
        return $this->body;
    }
    public function getShortDescription() {
        return substr($this->body, 0, 20);
    }
}
