<?php

/**
 * Description of ShView
 *
 * @author tiago
 */
class ShView {

    /**
     * Mantém somente o nome dos parametros no template {{nome}}
     * @param type $template
     * @return string conforme descirção. Usado com angular.js
     */
    public static function simplificaTemplate($template) {
        $parametros =  ShView::extraiParametros($template);
        $codigo = $template;
        foreach ($parametros as $paramID => $valorDefault) {
            $codigo = preg_replace('/{{' . $paramID . ':(.*?)}}/i', '{{' . $paramID . '}}', $codigo);
        }
        return $codigo;
    }

    /**
     * Faz merge do template com os valores dos parametros cadastrados, caso o parâmetro não esteja cadastrado o valor default é incluíod.
     * @param type $template
     * @param type $data
     * @return string codigo sem marcações
     */
    public static function mergeDataToTemplate($template, $content) {
        $parametros = ShView::extraiParametros($template);
        $codigo = $template;

        foreach ($parametros as $paramID => $data) {
            if ($data['isList']) {
                if (isset($content[$paramID]) && is_array($content[$paramID])) {
                    $valor = '[(' . implode('),(', $content[$paramID]['valor']) . ')]';
                } else {
                    $valor = $parametros[$paramID]['valor'];
                }
            } else {

              if(isset($content[$paramID]['valor']) && strlen($content[$paramID]['valor']) > 0){
                $valor = $content[$paramID]['valor'];
              } else {
                $valor = $data['valor'];
              }
            }

            $label = str_replace(array('@', '|'), array('\@', '\|'), $data['labelOriginal']);
            $codigo = preg_replace('/{{' . $label . ':(.*?)}}/i', $valor, $codigo);
            $codigo = preg_replace('/{{' . $label . '}}/i', $valor, $codigo);
        }

        return $codigo;
    }

    /**
     * Extrai parametros com valores default do template
     * @param type $template
     * @return type
     */
    public static function extraiParametros($template) {
        $parametros = $matches = array();
        preg_match_all('/{{(.*?)}}/i', $template, $matches);
        $data = $matches[1];

        foreach ($data as $d) {

            // Separa label e value
            if (strstr($d, ':')) {
                list($nomeParametro, $valorParametro) = explode(':', $d);
            } else {
                if (!in_array($d, array_keys($parametros))) {
                    $nomeParametro = $d;
                    $valorParametro = '';
                }
            }
            $labelOriginal = $nomeParametro;

            // Verifica tipo
            $dataTipo = array();
            preg_match_all('/\|(.*?)\|/i', $nomeParametro, $dataTipo);
            $tipo = 'str';
            if (isset($dataTipo[1]) && count($dataTipo[1]) > 0) {
                $tipo = $dataTipo[1][0];
                $nomeParametro = str_replace($dataTipo[0][0], '', $nomeParametro);
                if (!in_array($tipo, array('int'))) {
                    $tipo = 'str';
                }
            }


            // Identifica cardinalidade (1 ou n)
            $isList = false;
            if (substr($nomeParametro, 0, 1) === '@') {
                $nomeParametro = substr($nomeParametro, 1, strlen($nomeParametro) - 1);
                $isList = true;
            }

            $data = array(
                'valor' => $valorParametro,
                'tipo' => $tipo,
                'isList' => $isList,
//                'tptId' => $tptId,
                'labelOriginal' => $labelOriginal,
            );
            $parametros[$nomeParametro] = $data;
        }

        return $parametros;
    }

    /**
     * Agrupa valores de parametros do tipo template e lista
     * @param type $content
     * @return type
     */
    public static function normalizaTemplateData($template, $data) {
        $parms = ShView::extraiParametros($template);
        foreach ($parms as $id => $p) {
            if (isset($data[$id])) {
                if ($p['isList'] && $p['tipo'] == 'tpt') {
                    $data = $data[$id];
                    $newData = array();
                    foreach ($data as $k => $subData) {
                        foreach ($subData as $k2 => $v) {
                            if (!isset($newData[$k2][$k])) {
                                $newData[$k2][$k] = array();
                            }
                            $newData[$k2][$k] = $v;
                        }
                    }
                    $data[$id] = $newData;
                }
            }
        }
        return $data;
    }


    public static function normalizarSting($str) {
        $map = array(
          'á'=>'a','à'=>'a','ã'=>'a','â'=>'a','é'=>'e','ê'=>'e','í'=>'i','ó'=>'o',
          'ô'=>'o','õ'=>'o','ú'=>'u','ü'=>'u','ç'=>'c','Á'=>'A','À'=>'A','Ã'=>'A',
          'Â'=>'A','É'=>'E','Ê'=>'E','Í'=>'I','Ó'=>'O','Ô'=>'O','Õ'=>'O','Ú'=>'U',
          'Ü'=>'U','Ç'=>'C'
        );
        return strtolower(strtr($str, $map));
    }

}