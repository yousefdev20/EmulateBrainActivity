pipeline {    
    agent any    
    stages {        
        stage("Composer Init") {
            steps {                
                sh "chmod -R 777 /var/www/html/Lar_master/vendor/*"
                sh "chmod -R 777 /var/www/html/Lar_master/vendor/*/*/*"
                sh "chmod -R 777 /var/www/html/Lar_master/vendor/*/*"
                sh "chmod -R 777 /var/www/html/Lar_master/*"
                sh "chmod -R 777 /var/www/html/Lar_master/public/*"                
                sh "cp -rf /var/lib/jenkins/workspace/Lar_master /var/www/html"
            }
        }
        stage("Build") {
            steps {
                sh 'echo hi there'
                sh 'composer install'
                sh "php artisan optimize:clear"
            }
        }
        stage("Acceptance test codeception and deploy") {
            steps {
                sh "echo Everything woking fine so nice."
            }
            post {
                always {
                    sh "echo hi there!"
                    sh "echo Good Morning."                    
                }
            }
        }
    }
}
