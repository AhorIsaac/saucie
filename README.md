# Setup

Follow vividly this instructions to set up  the project.

1. [VSCode Installation](#vscode-installation)
2. [Xampp Installation](#xampp-installation)
3. [Download Project](#download-project)
4. [Export Database](#export-database)
5. [Login](#login)

## VSCode Installation

- [Download VSCode](https://code.visualstudio.com/download)
- During the installation, add VSCode to path.

## Xampp Installation

- [Download Xampp](https://www.apachefriends.org/download.html)
- During the installation, add Xampp to path.

## Download Project

Follow either ways to get this project to your PC

1. Download the project and extract it. Copy the extracted folder to *C:/xampp/htdocs/* or the installation path of Xampp on your PC. Right click and open the project in VSCode.
1. Clone the repository in *C:/xampp/htdocs/*. Right click and open the project in VSCode.

## Export Database

- Start your Xampp Control  Panel
  - Start Apache
  - Start MySQL
- Run __localhost/phpmyadmin__
  - Create a new database named __saucie__. If you create the database with a different name then enable to edit and rename the database in __saucie/classes/Database.php__ file.
  - Export the contents  of the file *saucie/database/saucie.sql* or *project-name/database/course_reg_system.sql* to your new database.
- Start your browser and run __localhost/saucie__ or __localhost/project-name__ if you renamed the project.

<br />

![index image](../public/images/saucie-10.png)
![index image](../public/images/saucie-14.png)
![index image](../public/images/saucie-15.png)

## Login

Login credentials are available in __login.txt__ file in *database* directory.

Enjoy!
