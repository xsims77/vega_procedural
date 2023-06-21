<?php

    get("/",            ["visitor/welcome/welcomeController", "index"]);

    // Auth
    get("/register",    ["visitor/registration/registerController", "register"]);
    post("/register",   ["visitor/registration/registerController", "register"]);
    get("/login",       ["visitor/authentication/loginController", "login"]);
    post("/login",      ["visitor/authentication/loginController", "login"]);
    get("/logout",      ["visitor/authentication/loginController", "logout"]);
    
    // User
    get("/user/home",           ["user/home/homeController", "index"]);
    get("/user/profile",        ["user/profile/profileController", "index"]);
    get("/user/profile/edit",   ["user/profile/profileController", "edit"]);
    post("/user/profile/edit",   ["user/profile/profileController", "edit"]);




    // get("/hello", ["testController", "toGreat"]);

    // get("/users",["userController", "index"]);
    

    //test des routes
    // get("/product/edit/{id}", ["productController", "edit"]);

    // get("/post/delete/{id}/{slug}", ["postController", "delete"]);