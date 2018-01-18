<?php

namespace Inc\Utils;

use Inc\Base\BaseController;
use Inc\Base\WPUser;
use Inc\Database\DbBadge;
use Inc\Database\DbModel;
use Inc\Database\DbUser;
use Inc\Pages\Admin;
use templates\SettingsTemp;

/**
 * Class that permit to send badges.
 *
 * @author      Alessandro RICCARDI
 * @since       x.x.x
 *
 * @package     OpenBadgesFramework
 */
class SendBadge extends BaseController {
    const ER_JSON_FILE = "Error json file\n";
    const ER_SEND_EMAIL = "Error email\n";
    const ER_DB_INSERT = "Db insert error.\n";
    const SUCCESS = "Email success.\n";
    const ER_GENERAL = "General error";

    private $badge = null;
    private $jsonMg = null;
    private $wpBadge = null;
    private $field = null;
    private $level = null;
    private $receivers = null;
    private $evidence = null;

    /**
     * Initialization of all the variable.
     *
     * @author      Alessandro RICCARDI
     * @since       x.x.x
     *
     * @param int    $idBadge   the id of the badge
     * @param int    $idField   the id of the field
     * @param int    $idLevel   the id of the level
     * @param string $info      the additional from the teacher
     * @param array  $receivers the people that will receive the email
     * @param string $classId   the eventual class
     * @param string $evidence  the work of the student in url format
     */
    function __construct($idBadge, $idField, $idLevel, $info, $receivers, $classId = '', $evidence = '') {

        $this->badge = new Badge();
        $this->wpBadge = WPBadge::get($idBadge);
        $this->field = get_term($idField, Admin::TAX_FIELDS);
        $this->level = get_term($idLevel, Admin::TAX_LEVELS);
        $this->receivers = $receivers;
        $this->evidence = $evidence;

        //$this->badge->setIdUser($idUser); --> we will set it after for each student
        $this->badge->setIdBadge($this->wpBadge->ID);
        $this->badge->setIdField($this->field->term_id);
        $this->badge->setIdLevel($this->level->term_id);
        $this->badge->setIdClass($classId);
        $this->badge->setIdTeacher(WPUser::getCurrentUser()->ID);
        $this->badge->setTeacherRole(WPUser::getCurrentUser()->ID);
        $this->badge->setCreationDate(DbModel::now());
        //$this->badge->setJson($json); --> we will set it after
        $this->badge->setInfo($info);
        $this->badge->setEvidence($evidence ? $evidence : "none");

        $this->jsonMg = new JsonManagement($this->badge);

    }

    /**
     * This class do principal four important things,
     * crate the json file, crate the body, send the email
     * and store all of that information in the database.
     *
     * @author   Alessandro RICCARDI
     * @since    x.x.x
     *
     * @return string to determinate the status of the process.
     */
    public function send() {
        $options = get_option(SettingsTemp::OPTION_NAME);

        $subject = "Badge: " . $this->wpBadge->post_title . " Field: " . $this->field->name;
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            "From: " . isset($options[SettingsTemp::FI_SITE_NAME_FIELD]) ? $options[SettingsTemp::FI_SITE_NAME_FIELD] : '' .
            " &lt;" . isset($options[SettingsTemp::FI_EMAIL_FIELD]) ? $options[SettingsTemp::FI_EMAIL_FIELD] : '',
        );

        if (is_array($this->receivers)) {
            foreach ($this->receivers as $email) {

                // Creation of json file
                if ($jsonName = $this->jsonMg->creation($email)) {

                    if($idDbUser = $this->insertUserInDB($email)){
                        if($idDbBadge = $this->badge->saveBadgeInDb($idDbUser, $jsonName)){
                            if($message = $this->getBodyEmail($idDbBadge)) {
                                // Send the email
                                $retEmail = wp_mail($email, $subject, $message, $headers);
                                if (!$retEmail) return self::ER_SEND_EMAIL;

                            } else {
                                echo "Error for $email";
                            }
                        } else {
                            echo "Error for $email";
                        }
                    } else {
                        echo "Error for $email";
                    }
                } else {
                    return self::ER_JSON_FILE;
                }
            }
            return self::SUCCESS;
        } else {
            return self::ER_GENERAL;
        }
    }

    /**
     * Insert a user in the database and retrieve its id.
     * If is already stored in the DB the function will anyway
     * return the its id.
     *
     * @param $email
     *
     * @return false|int|null The id of the user or false on error.
     */
    private function insertUserInDB($email) {
        $dataUser = array(
            "email" => $email,
        );

        if ($user = get_user_by("email", $email)) {
            $dataUser["idWP"] = $user->ID;
        }

        return DbUser::insert($dataUser);
    }

    /**
     * Function that permit to create the body of the email.
     *
     * @author   Alessandro RICCARDI
     * @since    x.x.x
     *
     * @param int $idDbBadge id of the database row of the badge.
     *
     * @return string the body of the email in html format
     */
    private function getBodyEmail($idDbBadge) {
        $badgeLink = Badge::getLinkGetBadge($idDbBadge);

        $body = "
                <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                <html xmlns='http://www.w3.org/1999/xhtml'>
                    <head>
                            <meta http-equiv='Content-Type' content='text/html'; charset='utf-8' />
                    </head>
                    <body>
                        <div id='b4l-award-actions-wrap'>
                            <div align='center'>
                                <h1>BADGES FOR LANGUAGES</h1>
                                <h1><b>Congratulations you have just earned a badge!</b></h1>
                                <h2>Learn languages and get official certifications</h2>
                                <center>
                                    <a href='" . $badgeLink . "'>
                                        <img src='" . WPBadge::getUrlImage($this->wpBadge->ID) . "' width='150' height='150'/>
                                    </a>
                                </center>
                                <h2>" . $this->wpBadge->post_title . " - " . $this->field->name . "</h2>
                                <p>Open the link, and get the badge.</p>
                                <a href='" . $badgeLink . "'>$badgeLink</a>
                                <br><br><hr>
                                <p style='font-size:9px; color:grey '>Badges for Languages by My Language Skills, based in Valencia, Spain.
                                More information <a href='https://mylanguageskills.wordpress.com/'>here</a>.
                                Legal information <a href='https://mylanguageskillslegal.wordpress.com/category/english/badges-for-languages-english/'>here</a>.
                                </p>
                            </div>
                        </div>
                    </body>
            </html>
                ";
        return $body;
    }
}