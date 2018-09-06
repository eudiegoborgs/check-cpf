<?php

namespace App;

use App\BlackList;

class CPF
{
    private $_cpf = false;
    public function __construct(string $cpf) 
    {
        $this->_cpf = $cpf;
    }

    public function isValidCPF() 
    {
        // Verifica se um número foi informado
        if(empty($this->_cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $this->removeMask();
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($this->_cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($this->_cpf == '00000000000' || 
            $this->_cpf == '11111111111' || 
            $this->_cpf == '22222222222' || 
            $this->_cpf == '33333333333' || 
            $this->_cpf == '44444444444' || 
            $this->_cpf == '55555555555' || 
            $this->_cpf == '66666666666' || 
            $this->_cpf == '77777777777' || 
            $this->_cpf == '88888888888' || 
            $this->_cpf == '99999999999') {
            return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
        } else {   
            
            for ($t = 9; $t < 11; $t++) {
                
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $this->_cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($this->_cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }


    public function removeMask() 
    {
        // Verifica se um número foi informado
        if(empty($this->_cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $this->_cpf = preg_replace("/[^0-9]/", "", $this->_cpf);
        $this->_cpf = str_pad($this->_cpf, 11, '0', STR_PAD_LEFT);
        
        return $this->_cpf;
    }

    public function inBlackList(){
        $this->removeMask();
        return BlackList::where('cpf', $this->_cpf)->first();
    }

    public function insertInBlackList(){
        $this->removeMask();
        $data = BlackList::firstOrCreate([
            'cpf' => $this->_cpf
        ]);
        return $data->toArray();
    }
}
