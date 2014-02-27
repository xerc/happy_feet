<?php
/**
 * Created by PhpStorm.
 * User: bilal.arslan
 * Date: 21.02.14
 * Time: 12:52
 */
class Tx_HappyFeet_Service_FootnoteService {

	/**
	 *
	 * @param string $footnoteUids comma separated list of uid's of the "tx_aoefootnote_item" record
	 * @param array $conf optional (this will be automatically set, of this method is called via 'TYPOSCRIPT-userFunc')
	 * @throws UnexpectedValueException
	 * @return string The wrapped index value
	 */
	public function renderItemList($footnoteUids, $conf = array()) {
		// footnote-UID's are defined inside a FCE
		if (array_key_exists ( 'userFunc', $conf ) && array_key_exists ( 'field', $conf )) {
			$footnoteUids = $this->cObj->getCurrentVal ();
		}

		$footNotes = explode ( ',', $footnoteUids );
		$footNoteRepository = new Tx_HappyFeet_Domain_Repository_FootnoteRepository();

		$footNotesList = $footNoteRepository->getFootnotesByIds ( $footNotes );

        $content = "";
		foreach ( $footNotesList as $footNote ) {
			/** @var Tx_HappyFeet_Domain_Model_Footnote $foot */
			$content .= '<h2>' . $footNote->getTitle () . '</h2>';
			$content .= '<p>' . $footNote->getDescription () . '</p>';
		}

		return $content;
	}

	/**
	 * @param string $footnoteUids
	 * @param array $conf
	 * @return string
	 */
	public function getFootIds($footnoteUids, $conf = array()) {
		$footnoteUids = '';
		if (array_key_exists ( 'userFunc', $conf ) && array_key_exists ( 'field', $conf )) {
			$footnoteUids = $this->cObj->data['field_footnote_content'];
		}
		return  $footnoteUids;
	}
}