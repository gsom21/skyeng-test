<?php

namespace app\controllers;

use app\models\IndividualForm;
use app\models\LegalForm;
use app\models\UserForm;
use Yii;
use yii\web\Controller;

/**
 * Class RegistrationController
 * @package app\controllers
 */
class RegistrationController extends Controller
{
    public function actionIndex()
    {
        return $this->render('reg');
    }

    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionIndividual()
    {

        $userForm = new UserForm();
        $individualForm = new IndividualForm();

        if ($userForm->load(Yii::$app->request->post())
            && $individualForm->load(Yii::$app->request->post())
            && $userForm->validate()
            && $individualForm->validate()) {

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $userId = $this->saveUser($userForm, $db);
                $db->createCommand('INSERT INTO individual(user_id, inn) VALUES (?,?)')
                    ->bindValues([
                        1 => $userId,
                        2 => $individualForm->inn
                    ])
                    ->execute();
                $transaction->commit();

            } catch (\Exception $e) {
                $transaction->rollBack();
                // Вывести сообщение об ошибке
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                // Вывести сообщение об ошибке
                throw $e;
            }
            return $this->redirect('/');
        } else {
            return $this->render('individual', [
                'user' => $userForm,
                'individual' => $individualForm
            ]);
        }
    }

    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionLegal()
    {
        $userForm = new UserForm();
        $legalForm = new LegalForm();

        if ($userForm->load(Yii::$app->request->post())
            && $legalForm->load(Yii::$app->request->post())
            && $userForm->validate()
            && $legalForm->validate()) {

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $userId = $this->saveUser($userForm, $db);
                $db->createCommand('INSERT INTO legal(user_id, company_name, inn) VALUES (?,?,?)')
                    ->bindValues([
                        1 => $userId,
                        2 => $legalForm->companyName,
                        3 => $legalForm->inn
                    ])
                    ->execute();
                $transaction->commit();

            } catch (\Exception $e) {
                $transaction->rollBack();
                // Вывести сообщение об ошибке
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                // Вывести сообщение об ошибке
                throw $e;
            }
            return $this->redirect('/');
        } else {
            return $this->render('legal', [
                'user' => $userForm,
                'legal' => $legalForm
            ]);
        }
    }

    /**
     * @param UserForm $userForm
     * @param \yii\db\Connection $db
     * @return null
     */
    protected function saveUser(UserForm $userForm, \yii\db\Connection $db){
        $result = $db->createCommand('INSERT INTO "user"(first_name, second_name, patronymic, mail) VALUES (?,?,?,?) RETURNING id;')
            ->bindValues([
                1 => $userForm->firstName,
                2 => $userForm->secondName,
                3 => $userForm->patronymic,
                4 => $userForm->mail])
            ->queryOne();
        return $result['id'] ?? null;
    }
}