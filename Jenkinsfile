pipeline {    
    agent any    
    stages {        
        stage("Composer Init") {
            steps {                                
                sh "cp -rf /var/lib/jenkins/workspace/Lar_1_main /var/www/html/Lar_1_main"
                sh "cp -rf /var/www/html/Lar_1_main ../app"
            }
        }
        stage("Build") {
            steps {
                sh 'echo hi there'
                sh 'cd /var/www/html/app && composer install'
                sh "cd /var/www/html/app && php artisan optimize:clear"
            }
        }
        stage("Acceptance test codeception and deploy") {
            steps {
                sh "echo Everything woking fine so nice...."
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
