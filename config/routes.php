<?php

    get("/", ["visitor/welcome/welcomeController", "index"]);
    get("/register", ["visitor/registration/registerController", "register"]);
    post("/register", ["visitor/registration/registerController", "register"]);
    get("/login", ["visitor/login/loginController", "login"]);

    // get("/hello", ["testController", "toGreat"]);

    // get("/users",["userController", "index"]);
    

    //test des routes
    // get("/product/edit/{id}", ["productController", "edit"]);

    // get("/post/delete/{id}/{slug}", ["postController", "delete"]);