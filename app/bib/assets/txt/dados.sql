/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  mazera
 * Created: 26 de jan de 2021
 */



CREATE TABLE `bib_autores` (
  `aut_id` integer NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NULL,
  `autor` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `endereco` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `foto_imagem` varchar(128) NULL,
   primary key(aut_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bib_autores` (`aut_id`, `autor`, `email`, `endereco`, `foto_imagem`) VALUES
(1, 'Monteiro Lobato', 'lobato@email.com.br', 'SP', 'foto.gif'),
(2, 'José de Alencar', 'alencar@email.com.br', 'SP', 'foto.gif'),
(3, 'Cecília Meireles ', 'meireles@email.com.br', 'SP', 'foto.gif'),
(4, 'Carlos Drummond de Andrade', 'drummond@email.com.br', 'SP', 'foto.gif'),
(5, 'Machado de Assis', 'assis@email.com.br', 'SP', 'foto.gif'),
(6, 'Clarice Lispector', 'lispector@email.com.br', 'SP', 'foto.gif'),
(7, 'Graciliano Ramos', 'graciliano@email.com.br', 'SP', 'foto.gif'),
(8, 'Mario Quintana', 'quintana@email.com.br', 'SP', 'foto.gif'),
(9, 'João Cabral de Melo Neto', 'cabral@email.com.br', 'SP', 'foto.gif'),
(10, 'Guimarães Rosa', 'rosa@email.com.br', 'SP', 'foto.gif'),
(11, 'Luis Fernando Veríssimo', 'verissimo@email.com.br', 'SP', 'foto.gif'),
(12, 'Ana Maria Machado', 'machado@email.com.br', 'SP', 'foto.gif'),
(13, 'Chico Buarque de Holanda', 'chico@email.com.br', 'SP', 'foto.gif'),
(14, 'Adélia Prado', 'prado@email.com.br', 'SP', 'foto.gif'),
(15, 'Eva Furnari', 'furnari@email.com.br', 'SP', 'foto.gif'),
(16, 'Martha Medeiros', 'martha@email.com.br', 'SP', 'foto.gif'),
(17, 'Conceição Evaristo', 'evaristo@email.com.br', 'SP', 'foto.gif'),
(18, 'André Dahmer', 'dahmer@email.com.br', 'SP', 'foto.gif'),
(19, 'Marcelino Freire', 'freire@email.com.br', 'SP', 'foto.gif'),
(20, 'Marçal Aquino', 'aquino@email.com.br', 'SP', 'foto.gif'),
(21, 'Antônio Prata', 'prata@email.com.br', 'SP', 'foto.gif'),
(22, 'Ana Maria Gonçalves', 'anamaria@email.com.br', 'SP', 'foto.gif'),
(23, 'Veronica Stigger', 'veronica@email.com.br', 'SP', 'foto.gif'),
(24, 'Luisa Geisler', 'luisa@email.com.br', 'SP', 'foto.gif'),
(25, 'Raphael Montes', 'montes@email.com.br', 'SP', 'foto.gif'),
(26, 'Daniel Galera', 'galera@email.com.br', 'SP', 'foto.gif'),
(27, 'Ricardo Terto', 'terto@email.com.br', 'SP', 'foto.gif'),
(28, 'Ruth Rocha', 'ruti@email.com.br', 'SP', 'logo.gif');

