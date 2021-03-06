<?php

namespace acceptcrypto;

/**
*  AcceptCrypto class
*
*  @author AcceptCrypto
*/

class AcceptCrypto {

	public static function custom($name, $amount, $currency, $background = "FABD58", $email_address = "", $bearer) {

		$response = array();

		$url = "https://acceptcryp.to/api/v1/form";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, "label=".$name."&amount=".$amount. "&currency=".$currency."&background=".$background);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Authorization: Bearer " . $bearer
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($curl);

		if($result) {

			$result = json_decode($result, true);

			if(!$result["error"]) {

				$token = $result["token"];

				$url2 = "https://acceptcryp.to/api/v1/payment/".$token;

				$curl2 = curl_init($url2);
				curl_setopt($curl2, CURLOPT_POST, 1);
				curl_setopt($curl2, CURLOPT_POSTFIELDS, "email_address=".$email_address);
				curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
				$result2 = curl_exec($curl2);

				if($result2) {

					$result2 = json_decode($result2, true);

					if(!$result2["error"]) {

						$paymentToken = $result2["payment_id"];

						$response["error"] = false;
						$response["payment_id"] = $paymentToken;
						$response["url"] = "https://acceptcryp.to/checkout/".$paymentToken;

					} else {

						$response["error"] = true;

					}

				} else {

					$response["error"] = true;

				}

			} else {

				$response["error"] = true;

			}

		} else {

			$response["error"] = true;

		}

		return $response;

	}

	public static function checkout($token, $email_address = "") {

		$response = array();

		$url2 = "https://acceptcryp.to/api/v1/payment/".$token;

		$curl2 = curl_init($url2);
		curl_setopt($curl2, CURLOPT_POST, 1);
		curl_setopt($curl2, CURLOPT_POSTFIELDS, "email_address=".$email_address);
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
		$result2 = curl_exec($curl2);

		if($result2) {

			$result2 = json_decode($result2, true);

			if(!$result2["error"]) {

				$paymentToken = $result2["payment_id"];

				$response["error"] = false;
				$response["payment_id"] = $paymentToken;
				$response["url"] = "https://acceptcryp.to/checkout/".$paymentToken;

			} else {

				$response["error"] = true;

			}

		} else {

			$response["error"] = true;

		}

		return $response;

	}

    public static function tx($payment_id) {

        //confirm if payment is made and check transaction status on the Blockchain

        $response = array();

        if (isset($payment_id)) {

            $curl = curl_init("https://acceptcryp.to/api/v1/payment/".$payment_id);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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

    public static function email($token, $email) {

        //confirm if payment is made and check transaction status on the Blockchain

        $response = array();

        if (isset($tx_id)) {

            $curl = curl_init("https://acceptcryp.to/api/v1/email/".$token."/".$email);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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

    public static function transaction($payment_id, $bearer){

        //get transaction information (Address, Amount, tx_id)

        $response = array();

        if (isset($payment_id)) {

            $curl = curl_init("https://acceptcryp.to/api/v1/info/".$payment_id);
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