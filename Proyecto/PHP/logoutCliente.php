<?php
session_start();
session_destroy();

header("Location: /ProyectoIngSWIII/Proyecto/index.php");
