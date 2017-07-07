<?php
    include_once ROOT.'/model/camagruModel.class.php';

    class camagruController {
        public function actionStart() {
            camagruModel::start();

            return (true);
        }

        public function actionPhoto() {
            camagruModel::photoRoom();

            return (true);
        }

        public function actionAbout() {
            camagruModel::showAbout();

            return (true);
        }
    }