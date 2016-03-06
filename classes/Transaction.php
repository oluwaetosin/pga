<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transaction
 *
 * @author OLUWATOSIN
 */
class Transaction extends ABaseClass{
   protected $transaction_Id;
   //debit = 0, redit =1
   protected $type;
   protected $transaction_date;
    protected $amount;
    protected $member_Id;
}
