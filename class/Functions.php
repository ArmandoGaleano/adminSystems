<?php
    class Functions extends ConnectionDB{
        public function sendEmailResetPass($emailUser,$key){
            // emails para quem será enviado o formulário
            $destino = $emailUser;
            $assunto = "Recuperação de conta";

            // É necessário indicar que o formato do e-mail é html
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: suporte@competcomtodos.com <$email>';
            //$headers .= "Bcc: $EmailPadrao\r\n";
            $menssagemParaEnviar = "Link para recuperação de conta: http://localhost/adminSystems/nova-senha.php?key=".$key;
            $enviaremail = mail($destino, $assunto, $menssagemParaEnviar, $headers);
            if($enviaremail){
                return true;
            }
            else {
                return false;
            }
        }
    }
?>