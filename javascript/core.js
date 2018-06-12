/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var maincore = maincore || {};

(function () {
    "use strict";
    maincore = (function () {
        
        var openLogin = function () {
            document.getElementById('login-box').classList.toggle('item-open');
        };
        
        return {
            openLogin: openLogin
        };
    }());
}());