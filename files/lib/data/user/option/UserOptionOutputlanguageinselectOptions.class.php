<?php
// wcf imports
require_once(WCF_DIR.'lib/data/user/option/UserOptionOutput.class.php');
require_once(WCF_DIR.'lib/data/user/User.class.php');

/*
 * Implements an "Language in selectOptions" Class
 * @svn			$Id: UserOptionOutputlanguageinselectOptions.class.php 526 2009-11-11 19:52:05Z TobiasH87 $
 * @author		TobiasH and Sven Kutzner
 * @copyright	2009 Community4WCF.de and deixu.net
 * @license		GNU GENERAL PUBLIC LICENSE <http://www.gnu.org/licenses/gpl.html>
 * @package		com.woltlab.community.profile.languageinselectOptions
*/

class UserOptionOutputlanguageinselectOptions implements UserOptionOutput {
    /**
     * @see UserOptionOutput::getShortOutput()
     */
    public function getShortOutput(User $user, $optionData, $value) {
        return $this->getOutput($user, $optionData, $value);
    }
    
    /**
     * @see UserOptionOutput::getMediumOutput()
     */
    public function getMediumOutput(User $user, $optionData, $value) {
        return $this->getOutput($user, $optionData, $value);
    }
    /**
     * @see UserOptionOutput::getOutput()
     */
	public function getOutput(User $user, $optionData, $value) {
		$result = '';
		if($value != '' && preg_match_all("/([0-9]+)\:(.+)/i", $optionData['selectOptions'], $matches)) {
			$options = array_combine($matches[1], $matches[2]);
			$selected = explode("\n", $value);
			foreach ($selected as $key) {
				if(!empty($result)) $result .= "\n";
				$result .= WCF::getLanguage()->get($options[$key]);
			}
		}
		return nl2br($result);
	}
}
?>