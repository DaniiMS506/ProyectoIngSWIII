<?php
session_start();
session_destroy();

header("Location: /ProyectoIngSWIII/Proyecto/Login.html");
