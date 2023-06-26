<?php
declare(strict_types=1);
namespace App\Common\Trait;
use App\Common\Igolib\Igo;//ライブラリから別のPHPを呼び出す都合上あえてIgoフォルダの下にIgoがあるようにしてます。

/**
 * 文字列の操作に関するUtility
 *
 * @todo Utilityクラス事態が悪であるので、真偽だけを判断したり、加工は行っても
 *       絶対に状態は持たないを徹底すること。→Trailt化した
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Trait
 * @package none
 *
 */
trait StringTrait
{
    private string $igoDictionary = "Common\Igolib\ipadic";
    /**
     * あらゆる空白文字で分割し，重複を除外する
     * @param string 空白文字を含む文字列
     * @return array 分割した文字列
     */
    public function extractKeywords(string $input, int $limit = -1): array
    {
        return array_values(
            array_unique(
                preg_split(
                    "/[\p{Z}\p{Cc}]++/u",
                    $input,
                    $limit,
                    PREG_SPLIT_NO_EMPTY
                )
            )
        );
    }

    /**
     * 漢字をひらがなに変換する
     * @param string 空白文字を含む文字列
     * @return array 分割した文字列
     */
    public function kanji2Hira(string $text) : string
    {
        $igo = new Igo(app_path($this->igoDictionary));

        $result = $igo->parse($text);
        $str = "";
        foreach($result as $value){
            $feature = explode(",", $value->feature);
            $str .= isset($feature[7]) ? $feature[7] : $value->surface;
        }
        return mb_convert_kana($str, "c", "utf-8");

    }

    /**
     * ひらがなをローマ字に変換する
     * @param string 空白文字を含む文字列
     * @return array 分割した文字列
     */
    public function Kana2Romaji(string $str) : string
    {
        $str = mb_convert_kana($str, 'cHV', 'utf-8');

        $kana = array(
            'きゃ', 'きぃ', 'きゅ', 'きぇ', 'きょ',
            'ぎゃ', 'ぎぃ', 'ぎゅ', 'ぎぇ', 'ぎょ',
            'くぁ', 'くぃ', 'くぅ', 'くぇ', 'くぉ',
            'ぐぁ', 'ぐぃ', 'ぐぅ', 'ぐぇ', 'ぐぉ',
            'しゃ', 'しぃ', 'しゅ', 'しぇ', 'しょ',
            'じゃ', 'じぃ', 'じゅ', 'じぇ', 'じょ',
            'ちゃ', 'ちぃ', 'ちゅ', 'ちぇ', 'ちょ',
            'ぢゃ', 'ぢぃ', 'ぢゅ', 'ぢぇ', 'ぢょ',
            'つぁ', 'つぃ', 'つぇ', 'つぉ',
            'てゃ', 'てぃ', 'てゅ', 'てぇ', 'てょ',
            'でゃ', 'でぃ', 'でぅ', 'でぇ', 'でょ',
            'とぁ', 'とぃ', 'とぅ', 'とぇ', 'とぉ',
            'にゃ', 'にぃ', 'にゅ', 'にぇ', 'にょ',
            'ヴぁ', 'ヴぃ', 'ヴぇ', 'ヴぉ',
            'ひゃ', 'ひぃ', 'ひゅ', 'ひぇ', 'ひょ',
            'ふぁ', 'ふぃ', 'ふぇ', 'ふぉ',
            'ふゃ', 'ふゅ', 'ふょ',
            'びゃ', 'びぃ', 'びゅ', 'びぇ', 'びょ',
            'ヴゃ', 'ヴぃ', 'ヴゅ', 'ヴぇ', 'ヴょ',
            'ぴゃ', 'ぴぃ', 'ぴゅ', 'ぴぇ', 'ぴょ',
            'みゃ', 'みぃ', 'みゅ', 'みぇ', 'みょ',
            'りゃ', 'りぃ', 'りゅ', 'りぇ', 'りょ',
            'うぃ', 'うぇ', 'いぇ'
        );

        $romaji  = array(
            'kya', 'kyi', 'kyu', 'kye', 'kyo',
            'gya', 'gyi', 'gyu', 'gye', 'gyo',
            'qwa', 'qwi', 'qwu', 'qwe', 'qwo',
            'gwa', 'gwi', 'gwu', 'gwe', 'gwo',
            'sya', 'syi', 'syu', 'sye', 'syo',
            'ja', 'jyi', 'ju', 'je', 'jo',
            'cha', 'cyi', 'chu', 'che', 'cho',
            'dya', 'dyi', 'dyu', 'dye', 'dyo',
            'tsa', 'tsi', 'tse', 'tso',
            'tha', 'ti', 'thu', 'the', 'tho',
            'dha', 'di', 'dhu', 'dhe', 'dho',
            'twa', 'twi', 'twu', 'twe', 'two',
            'nya', 'nyi', 'nyu', 'nye', 'nyo',
            'va', 'vi', 've', 'vo',
            'hya', 'hyi', 'hyu', 'hye', 'hyo',
            'fa', 'fi', 'fe', 'fo',
            'fya', 'fyu', 'fyo',
            'bya', 'byi', 'byu', 'bye', 'byo',
            'vya', 'vyi', 'vyu', 'vye', 'vyo',
            'pya', 'pyi', 'pyu', 'pye', 'pyo',
            'mya', 'myi', 'myu', 'mye', 'myo',
            'rya', 'ryi', 'ryu', 'rye', 'ryo',
            'wi', 'we', 'ye'
        );

        $str = $this->kana_replace($str, $kana, $romaji);

        $kana = array(
            'あ', 'い', 'う', 'え', 'お',
            'か', 'き', 'く', 'け', 'こ',
            'さ', 'し', 'す', 'せ', 'そ',
            'た', 'ち', 'つ', 'て', 'と',
            'な', 'に', 'ぬ', 'ね', 'の',
            'は', 'ひ', 'ふ', 'へ', 'ほ',
            'ま', 'み', 'む', 'め', 'も',
            'や', 'ゆ', 'よ',
            'ら', 'り', 'る', 'れ', 'ろ',
            'わ', 'ゐ', 'ゑ', 'を', 'ん',
            'が', 'ぎ', 'ぐ', 'げ', 'ご',
            'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
            'だ', 'ぢ', 'づ', 'で', 'ど',
            'ば', 'び', 'ぶ', 'べ', 'ぼ',
            'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ'
        );

        $romaji = array(
            'a', 'i', 'u', 'e', 'o',
            'ka', 'ki', 'ku', 'ke', 'ko',
            'sa', 'shi', 'su', 'se', 'so',
            'ta', 'chi', 'tsu', 'te', 'to',
            'na', 'ni', 'nu', 'ne', 'no',
            'ha', 'hi', 'fu', 'he', 'ho',
            'ma', 'mi', 'mu', 'me', 'mo',
            'ya', 'yu', 'yo',
            'ra', 'ri', 'ru', 're', 'ro',
            'wa', 'wyi', 'wye', 'wo', 'n',
            'ga', 'gi', 'gu', 'ge', 'go',
            'za', 'ji', 'zu', 'ze', 'zo',
            'da', 'ji', 'du', 'de', 'do',
            'ba', 'bi', 'bu', 'be', 'bo',
            'pa', 'pi', 'pu', 'pe', 'po'
        );

        $str = $this->kana_replace($str, $kana, $romaji);

        $str = preg_replace('/(っ$|っ[^a-z])/u', "xtu", $str);
        $res = preg_match_all('/(っ)(.)/u', $str, $matches);
        if(!empty($res)){
            for($i=0;isset($matches[0][$i]);$i++){
                if($matches[0][$i] == 'っc') $matches[2][$i] = 't';
                $str = preg_replace('/' . $matches[1][$i] . '/u', $matches[2][$i], $str, 1);
            }
        }

        $kana = array(
            'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
            'ヵ', 'ヶ', 'っ', 'ゃ', 'ゅ', 'ょ', 'ゎ', '、', '。', '　'
        );

        $romaji = array(
            'a', 'i', 'u', 'e', 'o',
            'ka', 'ke', 'xtu', 'xya', 'xyu', 'xyo', 'xwa', ', ', '.', ' '
        );
        $str = $this->kana_replace($str, $kana, $romaji);

        $str = preg_replace('/^ー|[^a-z]ー/u', '', $str);
        $res = preg_match_all('/(.)(ー)/u', $str, $matches);

        if($res){
            for($i=0;isset($matches[0][$i]);$i++){
                if( $matches[1][$i] == "a" ){ $replace = 'â'; }
                else if( $matches[1][$i] == "i" ){ $replace = 'î'; }
                else if( $matches[1][$i] == "u" ){ $replace = 'û'; }
                else if( $matches[1][$i] == "e" ){ $replace = 'ê'; }
                else if( $matches[1][$i] == "o" ){ $replace = 'ô'; }
                else { $replace = ""; }

                $str = preg_replace('/' . $matches[0][$i] . '/u', $replace, $str, 1);
            }
        }

        return $str;
    }

    /**
     * ひらがなをローマ字に変換する処理内の文字の置き換え処理
     * @param string 空白文字を含む文字列
     * @return array 分割した文字列
     */
    private function kana_replace(string $str,array $kana,array $romaji) : string
    {
        $patterns = array();
        foreach($kana as $value){
            $patterns[] = '/' . $value . '/';
        }

        $str = preg_replace($patterns, $romaji, $str);
        return $str;
    }
}