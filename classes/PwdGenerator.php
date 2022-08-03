<?php

namespace Classes;

class PwdGenerator
{
    public const LETTERS = 26;
    public const NUMBERS = 10;

    public function generatePwd(int $length, int $type): string
    {
        $pwd = $this->pickup_Chars($length);
        if (Password::WEAK != $type) {
            $pwd = $this->melt_charsTogether($pwd);
        }
        if (Password::STRONG == $type) {
            $pwd = $this->polish_Chars($pwd);
        }

        return $pwd;
    }

    private function pickup_Chars(int $length): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $num = '1234567890';
        $chars = [];
        for ($i = 0; $i < $length; ++$i) {
            $this->rand_isEven() ? $chars[$i] = $alphabet[rand(0, self::LETTERS) - 1] : $chars[$i] = $num[rand(0, self::NUMBERS) - 1];
        }

        return implode($chars);
    }

    private function melt_charsTogether(string $pwd): string
    {
        $special_chars = '!@_[)$(]-#';

        $i = 0;
        do {
            ++$i;
            $char_index = rand(0, strlen($special_chars) - 1);
            $pwd_index = rand(0, strlen($pwd) - 1);
            $pwd[$pwd_index] = $special_chars[$char_index];
        } while ($i < rand(5, 7));

        return $pwd;
    }

    private function polish_Chars(string $pwd): string
    {
        $pwd_index = rand(0, strlen($pwd) - 1);
        $pwd[$pwd_index] = '*';

        return $pwd;
    }

    private function rand_isEven(): bool
    {
        $rand = rand(0, 100);

        return 0 == $rand % 2 ? true : false;
    }
}
