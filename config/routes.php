<?php

    get("/", ["testController", "index"]);

    get("/post/edit/{id}", ["postController", "edit"]);
    

    //test des routes
    // get("/product/edit/{id}", ["productController", "edit"]);

    // get("/post/delete/{id}/{slug}", ["postController", "delete"]);