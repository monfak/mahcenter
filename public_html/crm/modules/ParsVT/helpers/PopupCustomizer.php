<?php
/* * *******************************************************************************
 * The content of this file is subject to the ParsVT Module license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTfarsi.ir are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 *  از این فایل برای سفارشی سازی پاپ آپ در کروم و ویندوز استفاده نمایید *
 * ****************************************************************************** */
class ParsVT_PopupCustomizer_Helper {

	var $showPopup;

	public function __construct( $show = false ) {
		$this->showPopup = $show;
	}

	public static function showComment( $record,$types, $customertype ,$currentUserModel) {
		$instance    = new self();
		$lastcomment = false;
		if ( $instance->showPopup === true ) {
			if ( in_array( "ServiceContracts", $types['types'] ) ) {
				$lastcomment .= ParsVT_V2_PBX_Asterisk::getServiceContracts( $record );
			}
			if ( in_array( "ModComments", $types['types'] ) ) {
				$getlastcomment = ParsVT_V2_PBX_Asterisk::getlastComment( $record, $customertype, $currentUserModel );
				$lastcomment    .= $getlastcomment;
			}
		}
		return $lastcomment;
	}

	public static function listSaveModules() {
		$instance = new self();
		$modules  = false;
		if ( $instance->showPopup === true ) {
			$modules = array();
			if ( Users_Privileges_Model::isPermitted( 'Leads', 'CreateView' ) ) {
				$modules[] = 'Leads';
			}
			if ( Users_Privileges_Model::isPermitted( 'Contacts', 'CreateView' ) ) {
				$modules[] = 'Contacts';
			}
			if ( Users_Privileges_Model::isPermitted( 'Accounts', 'CreateView' ) ) {
				$modules[] = 'Accounts';
			}
		}

		return $modules;

	}

	public static function SaveRecordModules( $data ) {
		$instance = new self();
		$record   = false;
		if ( $instance->showPopup === true ) {
			switch ( $data['module_name'] ) {
				case 'Contacts':
					$focus                             = CRMEntity::getInstance( 'Contacts' );
					$focus->mode                       = 'create';
					$focus->column_fields['firstname'] = isset( $data['name'] ) ? $data['name'] : '';
					$focus->column_fields['lastname']  = $data['last_name'];
					$focus->column_fields['mobile']    = $data['phone_number'];
					$focus->save( "Contacts" );

					return $focus->id;
					break;
				case 'Leads':
					$focus                             = CRMEntity::getInstance( 'Leads' );
					$focus->mode                       = 'create';
					$focus->column_fields['firstname'] = isset( $data['name'] ) ? $data['name'] : '';
					$focus->column_fields['lastname']  = $data['last_name'];
					$focus->column_fields['phone']     = $data['phone_number'];
					$focus->save( "Leads" );

					return $focus->id;
					break;
				case 'Accounts':
					$focus                                = CRMEntity::getInstance( 'Accounts' );
					$focus->mode                          = 'create';
					$focus->column_fields['tickersymbol'] = isset( $data['name'] ) ? $data['name'] : '';
					$focus->column_fields['accountname']  = $data['last_name'];
					$focus->column_fields['phone']        = $data['phone_number'];
					$focus->save( "Accounts" );

					return $focus->id;
					break;
			}

			return "NO";
		}

		return $record;

	}

    public static function SimoltelExtensionAPI($result = array()) {
        //array('ok' => '0', 'message' => 'Invalid Phone Number.');
        //array('ok' => '1', 'extension' => 122);
        if ($result['ok'] == '1' && isset($result['extension'])) {
            //if (!in_array($result['extension'], array(201,202,203,204,205,206,207,208))) {
            //    $result = array('ok' => (string)'0', 'message' => 'Phone crm extension not found.');
            //}
            return $result;
        }
    }

    public static function generateCallTrackerLinks($phone = "0" , $view = "Details", $module = false, $record = false) {
        $callTrackerUrl = '';
        require __DIR__."/../V2/PBX/config.php";
        if (empty($callTrackerUrl) || !filter_var($callTrackerUrl, FILTER_VALIDATE_URL)) {
            if (!empty($module)) {
                $url = 'm=' . $module . '&v=' . $view;
                if (!empty($record)) {
                    $url .= '&r=' . $record;
                }
                if ($phone != 0) {
                    $url .= '&p=' . $phone;
                }
            } else {
                $url = 'm=Leads&v=Edit&phone=' . $phone;
            }
        } else {
            $url = $callTrackerUrl;
            $url = "url=".vsprintf($url , array($phone));
        }
        return $url;
    }

}