<?php

namespace Ocd\NewsBundle\Model;

interface TimestampableInterface
{

    public function setCreatedAt();
    public function getCreatedAt();
    public function setUpdatedAt();
    public function getUpdatedAt();
    public function autoCreatedAt();
    public function autoUpdatedAt();

}

