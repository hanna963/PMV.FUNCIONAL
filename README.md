# Easy Vocabulary

Una aplicación web diseñada para aprender vocabulario de manera sencilla, rápida y eficiente. 

## 🚀 Características
- **Gestión de Usuarios:** Registro e inicio de sesión seguro.
- **Aprendizaje Interactivo:** Sistema de quices para medir el progreso.
- **Interfaz Limpia:** Diseño moderno con tonos aguamarina y mint para una experiencia de usuario profesional.
- **Seguimiento de Resultados:** Registro de puntuaciones para monitorear el aprendizaje.

## 🛠️ Tecnologías Utilizadas
- **Backend:** PHP
- **Base de Datos:** MySQL (Puerto 3309)
- **Frontend:** HTML5, CSS3
- **Editor:** Visual Studio Code

## 📋 Requisitos Previos
Para ejecutar este proyecto localmente, necesitas:
1. XAMPP instalado.
2. MySQL configurado en el puerto `3309`.
3. Clonar este repositorio en tu carpeta `htdocs`.

## ⚙️ Configuración
Asegúrate de ajustar los parámetros de conexión en tus archivos `.php`:
```php
$conexion = mysqli_connect("localhost:3309", "usuario", "contraseña", "easyvocabulary");
