pipeline {    
    agent any    
    stages {        
        stage("Composer Init") {
            steps {                                
                sh "cp -rf /var/lib/jenkins/workspace/Lar_1_main /var/www/html"
            }
        }
        stage("Build") {
            steps {
                sh 'echo hi there'
                sh 'cd /var/www/html/Lar_1_main && composer install'
                sh "cd /var/www/html/Lar_1_main && php artisan optimize:clear"
            }
        }
        stage("Acceptance test codeception and deploy") {
            steps {
                sh "echo Everything woking fine so nice.."
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
