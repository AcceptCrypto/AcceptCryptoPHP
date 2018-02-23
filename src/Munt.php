<?php

namespace muntpay

/**
*  Munt class
*
*  @author Munt
*/
class Munt {

    public static function tx($tx_id, $bearer) {

        //confirm if payment is made and check transaction status on the Blockchain

        $response = array();

        if (isset($tx_id)) {

            $curl = curl_init("https://getmunt.com/api/v1/payment/".$tx_id);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $bearer
            ));
            $result = curl_exec($curl);

            if ($result) {

                $result = json_decode($result, true);
                $response = $result;

            } else {

                $response["error"] = true;
                $response["message"] = "An error occurred";

            }

        } else {

            $response["error"] = true;
            $response["message"] = "Missing data";

        }

        return $response;

    }

    public static function email($token, $email, $bearer) {

        //confirm if payment is made and check transaction status on the Blockchain

        $response = array();

        if (isset($tx_id)) {

            $curl = curl_init("https://getmunt.com/api/v1/email/".$token."/".$email);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $bearer
            ));
            $result = curl_exec($curl);

            if ($result) {

                $result = json_decode($result, true);
                $response = $result;

            } else {

                $response["error"] = true;
                $response["message"] = "An error occurred";

            }

        } else {

            $response["error"] = true;
            $response["message"] = "Missing data";

        }

        return $response;

    }

    public static function transaction($tx_id, $bearer){

        //get transaction information (Address, Amount, tx_id)

        $response = array();

        if (isset($tx_id)) {

            $curl = curl_init("https://getmunt.com/api/v1/info/".$tx_id);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $bearer
            ));
            $result = curl_exec($curl);

            if ($result) {

                $result = json_decode($result, true);
                $response = $result;

            } else {

                $response["error"] = true;
                $response["message"] = "An error occurred";

            }

        } else {

            $response["error"] = true;
            $response["message"] = "Missing data";

        }

        return $response;

    }

}
