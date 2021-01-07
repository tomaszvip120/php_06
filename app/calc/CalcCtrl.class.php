<?php
// W skrypcie definicji kontrolera nie trzeba dołączać problematycznego skryptu config.php,
// ponieważ będzie on użyty w miejscach, gdzie config.php zostanie już wywołany.

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';

/** Kontroler kalkulatora
 * @author Przemysław Kudłacik
 *
 */
class CalcCtrl {

	private $msgs;   //wiadomości dla widoku
	private $infos;  //informacje dla widoku
	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku
	private $hide_intro; //zmienna informująca o tym czy schować intro

	/** 
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
		$this->hide_intro = false;
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->x = isset($_REQUEST ['x']) ? $_REQUEST ['x'] : null;
		$this->form->y = isset($_REQUEST ['y']) ? $_REQUEST ['y'] : null;
                $this->form->z = isset($_REQUEST ['z']) ? $_REQUEST ['z'] : null;
		$this->form->op = isset($_REQUEST ['op']) ? $_REQUEST ['op'] : null;
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->x ) && isset ( $this->form->y ) && isset ( $this->form->z ) && isset ( $this->form->op ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false;
		} else { 
			$this->hide_intro = true; //przyszły pola formularza - schowaj wstęp
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->x == "") {
			$this->msgs->addError('Nie podano kwoty');
		}
		if ($this->form->y == "") {
			$this->msgs->addError('Nie podano liczby lat');
		}
                if ($this->form->z == "") {
			$this->msgs->addError('Nie podano liczby procentów');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! $this->msgs->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->x )) {
				$this->msgs->addError('Pierwsza wartość nie jest liczbą');
			}
			
			if (! is_numeric ( $this->form->y )) {
				$this->msgs->addError('Druga wartość nie jest liczbą');
			}
                        
                        if (! is_numeric ( $this->form->z )) {
				$this->msgs->addError('Trzecia wartość nie jest liczbą');
			}
		}
		
		return ! $this->msgs->isError();
	}
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this->form->x = floatval($this->form->x);
			$this->form->y = floatval($this->form->y);
                        $this->form->z = floatval($this->form->z);
			$this->msgs->addInfo('Parametry poprawne.');
				
			//wykonanie operacji
			switch ($this->form->op) {
				case 'kredyt' :
                                    $zysk = ($this->form->x * $this->form->z)/100;
                                    $suma = $this->form->x + $zysk;
                                    $miesiace = $this->form->y * 12; 
					$this->result->result =($suma / $miesiace);
					$this->result->op_name = 'kredyt';
					break;
				case 'lokata' :
                                    
                                    $proc = $this->form->z * 0.01;
                
                                     for($a = 0; $a < $this->form->y; $a++){
                                     if($a==0){
                                     $b = $this->form->x * $proc;
                                     $koncowy = $b + $this->form->x;
                                     } else {
                                     $b = $koncowy * $proc;
                                     $wynik = $koncowy + $b;
                                     $koncowy = $wynik;
                                       }                              
                                        }
                                    
                                    
					$this->result->result = $koncowy;
					$this->result->op_name = 'lokata';
					break;
				default :
					$this->result->result = 12;
					$this->result->op_name = 'kredyt';
					break;
			}
			
			$this->msgs->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','Valentine Bank Calculator');
		$smarty->assign('page_description','Prosty kalkulator do obliczeń kredytu lub lokaty');
		$smarty->assign('page_header','Kontroler główny');
				
		$smarty->assign('hide_intro',$this->hide_intro);
		
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/calc/CalcView.tpl');
	}
}
