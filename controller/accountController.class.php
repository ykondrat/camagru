<?php
    include_once ROOT.'/model/userModel.class.php';

    class accountController {
        public function actionCreate() {
            userModel::createAccount();

            return (true);
        }

        public function actionLogin() {
            userModel::logIn();

            return (true);
        }

        public function actionLogout() {
            userModel::logOut();

            return (true);
        }

        public function actionModify() {
            userModel::modifyAccount();

            return (true);
        }

        public function actionActivation($login, $id) {
            userModel::setActivation($login, $id);

            return (true);
        }

    }