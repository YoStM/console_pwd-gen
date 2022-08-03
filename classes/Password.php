<?php

namespace Classes;

class Password
{
    public const STRONG = 1;
    public const MEDIUM = 2;
    public const WEAK = 3;

    public const MAX_LENGTH = 19;
    public const MIN_LENGTH = 15;

    private string $char_sequence;
    private int $length;
    private int $type;
    private bool $has_specialChars;
    private bool $has_Uppercase;
    // private PwdGenerator $pwd_gen;

    public function __construct(int $type)
    {
        $this->type = $type;
        $this->length = rand(self::MIN_LENGTH, self::MAX_LENGTH);
    }

    public function unvail_CharSequence(): string
    {
        $pwd_gen = new PwdGenerator();
        $this->char_sequence = $pwd_gen->generatePwd($this->length, $this->type);

        return $this->char_sequence;
    }

    public static function display_robustnessAsStr(int $robustnessLvl): string
    {
        $robustenessAsStr = '';

        switch ($robustnessLvl) {
            case self::STRONG: $robustenessAsStr = 'élevé';

                break;

            case self::MEDIUM: $robustenessAsStr = 'moyen';

                break;

            case self::WEAK: $robustenessAsStr = 'faible';

                break;

            default: $robustenessAsStr = 'inconnu';
        }

        return $robustenessAsStr;
    }

    public static function robustness_IsValid(int $robustness): bool
    {
        if ((int) $robustness < self::STRONG || (int) $robustness > self::WEAK) {
            return false;
        }

        return true;
    }
}
