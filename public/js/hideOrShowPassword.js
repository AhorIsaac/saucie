            function viewPassword1() {
                var eye = document.getElementById('eye1');
                var passfield = document.getElementById('password-field1');
                
                if (passfield.type == 'password') {
                    passfield.type = "text";
                    eye.classList.toggle('fa-eye');
                } else {
                    passfield.type = "password";
                    eye.classList.toggle('fa-eye-slash');
                }
            }
            
            function viewPassword2() {
                var eye = document.getElementById('eye2');
                var passfield = document.getElementById('password-field2');
                
                if (passfield.type == 'password') {
                    passfield.type = "text";
                    eye.classList.toggle('fa-eye');
                } else {
                    passfield.type = "password";
                    eye.classList.toggle('fa-eye-slash');
                }
            }
            
            
            function viewPassword3() {
                var eye = document.getElementById('eye3');
                var passfield = document.getElementById('password-field3');
                
                if (passfield.type == 'password') {
                    passfield.type = "text";
                    eye.classList.toggle('fa-eye');
                } else {
                    passfield.type = "password";
                    eye.classList.toggle('fa-eye-slash');
                }
            }
