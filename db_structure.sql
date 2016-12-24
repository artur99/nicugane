-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2016 at 09:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nicugane`
--
CREATE DATABASE IF NOT EXISTS `nicugane` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nicugane`;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `link` text,
  `content` text NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `image`, `link`, `content`, `priority`) VALUES
(1, 'Revista Noastră', '', NULL, 'În decursul anilor elevii noştri şi-au manifestat creaţiile literar-artistice şi ştiinţifice în „REVISTA NOASTRĂ” care anul acesta a ajuns la cel de-al LXXII-lea număr.', 1),
(2, 'ECDL - Centru Testare', 'misc/ecdl.jpg', NULL, 'Centrul RO 311 Colegiul Naţional „Nicu Gane” Fălticeni este Centru de Testare Acreditat ECDL<br>Permisul european de conducere a computerului (ECDL – European Computer Driving Licence) este cel mai răspândit standard de certificare a abilităţilor de utilizare a computerului, recunoscut la nivel internaţional.<br>Permisul ECDL este folosit şi recunoscut în 150 de ţări  de către companii de renume, în administraţie sau de instituţii de învăţământ de prestigiu. În afara Europei, programul este denumit International Computer Driving Licence (ICDL).<br>', 2),
(3, 'Cisco Academy', 'misc/cisco.jpg', NULL, 'IT Essential: PC Hardware and Software<br>Explicarea certificarilor din industria IT', 2),
(4, 'Proiecte și Parteneriate', '', NULL, 'I. Parteneri<br> Prin natura activităţilor pe care le desfăşurăm, partenerii noştri sunt în primul rând instituţii de învăţământ.', 3),
(5, 'Photosfera', 'misc/sfera.jpg', 'http://www.photosfera.nicugane.ro/', 'Albumul iubitorilor de arta fotografica', 2),
(6, 'Clubul Debate-Logos', 'misc/club_debate.jpg', 'https://nicugane.files.wordpress.com/2014/02/logos-debate.pdf', 'Vrei să înveţi cum să-ţi argumentezi corect ideile', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catd_articles`
--

CREATE TABLE `catd_articles` (
  `id` int(11) NOT NULL,
  `catd_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `date` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` int(11) NOT NULL,
  `pinned` tinyint(4) NOT NULL,
  `attachment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catd_articles`
--

INSERT INTO `catd_articles` (`id`, `catd_id`, `user_id`, `title`, `date`, `content`, `type`, `pinned`, `attachment`) VALUES
(1, 3, 5, 'The quick brown fox', 1474452506, 'The quick brown fox told me that he can jump over the lazy dog, and then I just wanted to check this out. So, after a few hours of Hi-Quai testing and Slow-Mow video recording, we published an entire study, along with a book with instructions, a book of about two thousands forty four pages telling about how each point and each atom and each molecule form that fox simplu jumped over that sleeping weird lazy and very lazy, and also sleeping dog. It was a sure success! :DDD', 1, 0, '0'),
(2, 3, 4, 'The quick green fox', 192829284, 'The quick brown fox told me that he can jump over the lazy dog, and then I just wanted to check this out. So, after a few hours of Hi-Quai testing and Slow-Mow video recording, we published an entire study, along with a book with instructions, a book of about two thousands forty four pages telling about how each point and each atom and each molecule form that fox simplu jumped over that sleeping weird lazy and very lazy, and also sleeping dog. It was a sure success! :DDD', 1, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `catd_roles`
--

CREATE TABLE `catd_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `catd_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catd_roles`
--

INSERT INTO `catd_roles` (`id`, `user_id`, `catd_id`) VALUES
(1, 4, 3),
(2, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `catds`
--

CREATE TABLE `catds` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catds`
--

INSERT INTO `catds` (`id`, `slug`, `name`, `image`) VALUES
(1, 'matematica', 'Matematică', 'misc/mate.jpg'),
(2, 'limba-romana', 'Limba Română', 'misc/rom.jpg'),
(3, 'informatica', 'Informatică', 'misc/info.png'),
(4, 'chimie', 'Chimie', 'misc/chimie.jpg'),
(5, 'fizica', 'Fizică', 'misc/fiz.jpg'),
(6, 'tic', 'TIC', 'misc/tic.jpg'),
(7, 'biologie', 'Biologie', 'misc/biologie.jpg'),
(8, 'istorie', 'Istorie', 'misc/istorie.jpg'),
(9, 'geografie', 'Geografie', 'misc/europa.jpg'),
(10, 'limba-engleza', 'Limba Engleză', 'misc/londra.jpg'),
(11, 'limba-franceza', 'Limba Franceză', 'misc/paris.jpg'),
(12, 'limba-germana', 'Limba Germană', 'misc/berlin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `link` text,
  `content` text NOT NULL,
  `date` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `link`, `content`, `date`, `priority`) VALUES
(1, 'Salvează un destin', 'http://www.nicugane.ro/articole/salveaza.jpg', NULL, 'Salvează un destin" este o campanie umanitară ce vine în sprijinul unui tânăr de 18 ani, a cărui viaţă a fost radical schimbată de un groaznic accident rutier. \nTeribilismul unui şofer imprudent şi zelul unei seri de sâmbătă cu prietenii au condus la distrugerea fizică a acestuia şi spulberarea viitorului său riguros plănuit.\nElev în clasa a 12-a, adolescentul îşi pregătea bagajul de cunoştinţe pentru examenul de bacalaureat, visa să urmeze o facultate bazată pe efort fizic şi să rezoneze cu prietenii săi în cele mai importante momente din viaţa unui tânăr aflat în ultima etapă a educaţiei preuniversitare.\nIncidentul i-a cauzat grave leziuni la coloana vertebrală şi la unul din membrele inferioare, tipul afecţiunilor având caracter de noutate în România şi neexistând posibilitatea unei intervenţii medicale în ţară. Singura şansă de salvare este oferită de o clinică din Turcia, ce este dotată cu aparatura necesară unei reconstrucţii complete a oaselor fracturate. \nCosturile întregului proiect medical se estimează la minim 20.000 €, sumă ce depăşeşte substanţial nivelul economiilor unei familii modeste din România. \nImpactul suferit i-a generat o traumă psihică majoră, realizând că viaţa sa va avea o altă turnură decât cea imaginată de mintea sa idealistă şi ambiţioasă.\nCu durere în suflet şi zguduiţi de cele întâmplate, prietenii şi colegii săi am decis să luptăm, încărcaţi cu toate armele necesare, însa în acest război avem nevoie de o armată de suflete, fiecare contribuind la readucerea armoniei în viaţa şi sănătatea victimei, pentru a îl ajuta să îşi contureze noul destin.\nDacă găsiţi în inimile voastre puterea să îl ajutaţi, donaţiile se fac în contul:\nRO46BTRL03401201R13225XX\n-BancaTransilvania-\n#‎salveazaundestin', 1466490042, 2),
(2, 'Formare profesională în Germania', 'http://media.cronicadefalticeni.ro/actualitate/201605/76103/erasmus1-1170x480.jpg', NULL, 'Elevi de la Colegiul Național „Nicu Gane” Fălticeni participă, în perioada 2-20 mai, în Germania, la Dresda, la activităţi în cadrul unui proiect Erasmus+, Acțiunea Cheie 1 – Mobilități de formare profesională, ne-a informat prof. Ioan Caulea, coordonatorul proiectului.\n\nDin grup fac parte 15 elevi de clasa a X-a, specializarea Matematică-Informatică, care efectuează un stagiu de formare profesională în domeniul Webdesign-ului și al comerțului electronic la o instituție de profil din Germania. Două cadre didactice îi însoţesc pe elevi în Germania: prof. Florin Ilincăi (Informatică) și de  prof. Ioan Caulea.\n\nScopul proiectului este promovarea calităţii în educaţia şi formarea profesională iniţială şi continuă, printr-un stagiu de pregatire a elevilor de clasa a X-a de la specializarea Matematica-Informatica, printre care şi elevi domiciliaţi în mediul rural, într-o companie cu experienţă în web-design şi antreprenoriat, în scopul dobandirii de competente profesionale corespunzatoare noilor cerinţe de pe piata europeană a muncii.\n\nPotrivit prof. Ioan Caulea, obiectivele propuse prin acest proiect, primul de acest tip la Colegiul Național „Nicu Gane”, sunt:  formarea unor deprinderi practice şi competenţe de a utiliza strategii informatice complexe, prin insuşirea metodelor şi modelelor de bună practică din domeniile Webdesign-ului si Web-business-ului, în scopul facilitării dezvoltării personale şi a inserţiei profesionale pe piaţa europeană a muncii; stimularea spiritului antreprenorial prin dezvoltarea în rândul elevilor de liceu a abilităţilor necesare construirii website-urilor, abilităţi utile aplicării ideilor de afaceri în mediul virtual; îmbunătăţirea competenţelor sociale, culturale şi lingvistice, de comunicare atât în mediul real, cât şi cel virtual.', 1466490041, 2),
(3, 'Food Revolution Day la Colegiul Naţional „Nicu Gane”', 'misc/food-revolution-day.jpg', NULL, 'IT Essential: PC Hardware and Software<br>Explicarea certificarilor din industria IT', 1466490040, 2),
(4, 'Calificați la olimpiade, faza națională\n', 'http://www.nicugane.ro/albumfoto/rwx_gallery/olimpici.jpg', NULL, 'I. Parteneri<br> Prin natura activităţilor pe care le desfăşurăm, partenerii noştri sunt în primul rând instituţii de învăţământ.', 1466490039, 2),
(5, 'Reuniune în cadrul proiectului The Voice of Young Europe', 'http://media.cronicadefalticeni.ro/actualitate/201603/74866/the_voice_of_young_europe_reuniune_falticeni_1.jpg', '', 'Test test', 1466490038, 2),
(6, 'Două noi investiții ale Primăriei au fost finalizate la Colegiul ”Nicu Gane”\n', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6eqk4v3uBswE8L-IajJ9bSVE6lGJFJmL98XzE12D9K8q8rIxkxQ', '', 'Vrei să înveţi cum să-ţi argumentezi corect ideile', 1466490037, 2),
(7, 'De la legendă şi mit la adevăr ştiinţific\r\n', '', NULL, 'Joi, 12 noiembrie 2015, în amfiteatrul Colegiului, un grup de inimoşi elevi din clasa a XII-a F au demonstrat un adevăr posibil şi au rezolvat o dilemă: legendele şi miturile pot sta la temelia unor realităţi istorice, ştiinţifice ori tehnice. În fond, deplasarea covorului fermecat, zborul calului năzdrăvan cu viteza vântului sau a gândului, călătoria spre tărâmul tinereţii veşnice, toate  şi multe altele au anticipat fundamentele gândirii ştiinţifice, ale inventivităţii şi ale creativităţii. \r\n            Tema proiectului – Cum ar fi putut Arhimede să aprindă corăbiile romane – a avut componentă multidisciplinară: istorie, matematică, fizică, chimie, tehnologie, informatică, literatură, mitologie. Ne-am organizat echipa la sugestiile domnilor profesori. Documentare şi apoi muncă riguroasă. Am realizat părţile în Word, PowerPoint şi, în final, am susţinut public proiectul.\r\n            Arhimede, cea mai strălucită minte a antichităţii, a fost şi un nemaipomenit strateg militar, inginer şi executor al maşinilor de război care ar fi pregătit cu precizie ştiinţifică şi tehnică oglinzile care să aprindă corăbiile comandantului roman Marcellus în anul 212 î.e.n.. Negreşit că arma lui a fost lentila convergentă. Se poate ca scuturile din bronz şi cupru, fin polizate, să fi putut concentra razele soarelui. Acestea ar fi acţionat colectiv ca o oglindă parabolică sau ca un cuptor solar.\r\n            De altfel, problema a stat în atenţia comunităţii ştiinţifice internaţionale Raportul dintre aproapele şi departele, respectiv distanţa oglindă-ecran sau soldat-corabie a fost  calculată cu maximă precizie în 1973 de către filosoful grec Sakkos ce a reuşit experimentul. Fizicianului grec a folosit 70 de soldaţi echipaţi cu câte o oglindă metalică de cupru cu dimensiunile: 90×150 cm2 ce au dirijat fasciculul luminos reflectat spre o copie a unei corăbii de lemn aflată la 200 metri de mal, ceea ce a dus la aprinderea corăbiei în câteva secunde.\r\n            Cealaltă ipoteza că 392 de soldaţi echipaţi cu oglinzi plane ar fi trimis fascicule luminoase concentrate în aceeaşi zonă aprinzând corăbiile am demonstrat-o prin calcul matematic având cauzalitate fizică şi motivaţie chimică. \r\n            Victoria s-a datorat capacităţii militare a savantului siracuzian. Soarta lui Arhimede a fost însă tragică. În neorânduiala de după victorie, romanii au pătruns în cetate.            Marcellus a ordonat ca savantul să fie protejat, dar un soldat, nedându-şi seama de valoarea bătrânului ce făcea o demonstraţie pe nisip, l-a ucis pe cel ce-şi apăra cercetarea: non tangere circulos meos! \r\n            Vicleşugul Calului Troian a dus la distrugerea Troiei. Barbaria romanului a adus  moarte celei mai luminate minţi a antichităţii. Şi totuşi, câte şi câte invenţii de la Arhimede a moştenit omenirea: legile fundamentale ale pârghiilor şi scripeţilor, legile de bază ale hidrostaticii şi plutirii corpurilor, roata dinţată, şurubul fără sfârşit şi catapulta. Părinte al mecanicii având contribuţii majore în statică, matematician, astronom, filosof, inginer, strateg militar şi figură ilustră a antichităţii. \r\n            Demonstraţia noastră este doar un punct de vedere pe care îi puteţi îmbrăţişa sau căuta alte explicaţii sau cauzalităţi. În euforia momentului şi a demonstraţiei noastre, avem tăria de a striga Evrika!, noi, cei din clasa a XII-a F, încurajaţi de profesorii noştri Liliana Oniciuc şi Sorin Gafencu, după care semnăm cu gratitudine: Bobu Vasilica Carmen, Brădăţanu Mădălina, Gogu Loredana, Guţă Roxana, Moroşanu Teodora Ruxandra, Pavăl Andreea, Pavăl Laura, Tanasă Mădălina, Tanasă Sorina şi Murariu Vlad, mulţumind asistenţei formate din elevii claselor a X-a F, a X-a G, a XI-a C, şi a XII-a G.', 1466490036, 2),
(8, 'Elevi și profesori premiați de MECȘ\r\n', '', NULL, 'Luni, 16 noiembrie 2015, Guvernul României a organizat festivitatea de premiere a elevilor care au obținut distincții la olimpiadele și concursurile internaționale 2015, a profesorilor care i-au pregătit și a unităților școlare de proveniență.\r\nColegiul Național ” Nicu Gane” a fost reprezentat de către prof.dr. Porof Marcel și prof. Pavel Daniela, profesori îndrumători pentru Davidel Lorena (bronz la Olimpiada internațională de geografie) și Pălie Larisa-Andreea (mențiune la Olimpiada internațională de lectură).\r\nPremierea a fost făcută de Primul-ministru interimar al României şi ministru al Educaţiei şi Cercetării Ştiinţifice, Sorin Mihai Cîmpeanu.', 1466490035, 2),
(9, 'Echinoxul taifasului şi alte povestiri', '', NULL, 'Ziua de 27 octombrie 2015 a lăsat deschisă încă o uşă în existenţa Colegiului Naţional ,,Nicu Gane”…Găzduirea marelui scriitor fălticenean Grigore Ilisei, dar şi lansarea celor două cărţi de tip interviu, i-a invitat pe elevi într-o convorbire despre apărarea valorilor naţionale, precum şi despre un început strălucit în carieră. Cu alte cuvinte,  prin cele două cărţi s-a dus la conchiderea ideii că, atunci când eşti tânăr şi pasionat de ceea ce faci, nu poţi fi legat de nimic! Profesorul Neculai Sturzu a realizat o frumoasă prezentare iar scriitorul Grigore Ilisei s-a adresat publicului rostind vorbe meşteşugite şi pline de farmec.\r\nÎn cadrul acestui eveniment, au fost lansate două noi volume semnate Grigore Ilisei, două volume de interviuri pentru că, aşa cum se ştie despre autor, este unul dintre marii oameni de cultură ai României şi, mai mult de atât, jurnalist. În prima carte, „Convorbiri, taifasuri, divanuri, portrete”, au fost intervievate mari personalităţi tocmai de cel ce a mânuit penelul în scrierea acestei cărţi, personalităţi cu răsunet în literatura românească şi nu numai, precum Eugen Barbu, care se situează, alături de C. Negruzzi, N. Filimon şi L. Rebreanu, printre cei mai mari scriitori ai literaturii noastre, Înaltpreasfinţitul Teofan şi Arhimandritul Timotei Aioanei. Această carte ne oferă oportunitatea de a afla de autori cu renume, pe care nu îi studiem la şcoală şi, mai mult de atât, sunt tratate subiecte precum succesul în carieră sau începutul carierei unor mari oameni, ce pot fi de mare ajutor, mai ales nouă, liceenilor, care avem nevoie de modele puternice.\r\nA doua carte, intitulată „Interviuri de Zoe Dumitrescu Buşulenga” este, aşa cum îi spune şi titlul, o carte „şlefuită” de către domnul Grigore Ilisei, care a cules toate interviurile acestei personalităţi şi le-a dat forma finală, legată între două coperţi, scrisă pe hârtie cu miros de tiparniţă, hârtie ce emană prin conţinutul ei cultură şi iubirea de adevăratele valori.\r\nGrigore Ilisei a pendulat toată viaţa între două mari preocupări: presa şi literatura, dar, prin apariţia acestor portrete verbale, scriitorul a demonstrat încă o dată că exigenţa propriilor valori ţine de o minte strălucită și de o cultură generală extraordinară cultivată de-a lungul unei existenţe implacabile.\r\n,,Mie, scrierile lui Grigore Ilisei îmi confirmă ingenuu, pentru a nu ştiu câta oara, ceea ce am descoperit involuntar, încă de la răsfoirea primei pagini a unui volum de proză: candoare, siguranţă, o recrudescenţă a simplităţii latente…”  (Cătălina Sofron)\r\n„Pentru mine, activitatea de astăzi a fost o activitate cu o încărcătură culturală inefabilă, cu emoţii de nedescris având în faţă un om atât de important şi câteva sfaturi şi cunoştinţe adăugate la băgăjelul personal, cea mai importantă fiind aceea de a lupta pentru visul meu, raportându-mă la cei din familia mea care au reuşit, întărite de o replică, „ăştia sunt rudele tale”.” (Iuliana Şoldănescu)', 1466490034, 2),
(10, 'Trei ani de investiţii la Colegiul "Nicu Gane": Fonduri de 1,2 milioane lei \r\nalocate de Primăria Fălticeni', '', NULL, 'Sprijin pentru actul educaţional. În ultimii trei ani, autorităţile locale s-au dovedit generoase cu unităţile de învăţământ fălticenene care au primit sume de bani importante pentru demararea unor lucrări sau achiziţii de maximă necesitate. Din bugetul local pe 2015 un sfert din secţiunea investiţii va merge spre grădiniţe, şcoli gimnaziale şi colegii.\r\nLa Colegiul Naţional "Nicu Gane" s-au alocat în ultimii trei ani 1,2 milioane de lei. Primăria a scos din visterie câte 400.000 lei pentru rezolvarea problemelor prioritare.\r\nUnitatea de învăţământ, care anul acesta are 18 elevi participanţi la olimpiadele naţionale, şi-a direcţionat fondurile primite de la municipalitate preponderent spre îmbunătăţirea condiţiilor oferite elevilor.\r\n"Sumele pe care le-am primit sunt importante şi arată faptul că primarul Coman sprijină învăţământul local", ne-a declarat directorul adjunct Laurenţiu Tomescu. "Banii alocaţi pentru Colegiul Naţional "Nicu Gane" sunt foarte importanţi pentru că era mare nevoie să facem lucrări de modernizare pentru a putea toate condiţiile necesare desfăşurării actului educaţional. Noi, profesorii, ne dorim să desfăşurăm un act educaţional de calitate şi cred că rezultatele noastre, prin elevii noştri, confirmă acest lucru. "\r\nAcesta spune că investiţiile pentru anul şcolar 2014 – 2015 se vor axa pe trei capitole. Sumele de bani primite vor fi cheltuite pentru anveloparea termică a corpului B şi reparaţii la sala mică de sport.\r\nÎn acelaşi timp vor fi realizate lucrări de anvelopare şi reparaţii şarpantă la clădirea internatului.\r\nLucrările de investiţie se vor finaliza în vara acestui an.\r\nLaurenţiu Tomescu a precizat că în anii anteriori, 2012-2013 şi 2013 – 2014, din fondurile primite de la bugetul local s-au achiziţionat două noi centrale termice pe gaz, s-a reabilitate sala mare de sport, iar terenul de sport a primit gazon artifical şi instalaţie nocturnă.\r\nDe asemenea, s-au făcut anvelopări ale clădirilor, modernizări la interiorul internatului, iar tâmplăria şi geamurile au fost înlocuite.', 1466490033, 2);

-- --------------------------------------------------------

--
-- Table structure for table `static`
--

CREATE TABLE `static` (
  `id` int(11) NOT NULL,
  `name` text,
  `content` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `fb_id` varchar(50) NOT NULL,
  `password` text,
  `prof` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `name` text,
  `image` varchar(200) DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '5',
  `rdate` int(11) DEFAULT NULL,
  `ldate` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fb_id`, `password`, `prof`, `admin`, `name`, `image`, `priority`, `rdate`, `ldate`, `data`) VALUES
(1, 'david1989mail@yahoo.com', '', '098f6bcd4621d373cade4e832627b4f6', 0, 1, 'Vultur David', 'profile/artur99.jpg', 1, 1473694077, 1474966270, '{}'),
(2, 'vodageorgian@', '', 'test', 0, 1, 'Vodă Georgian', NULL, 1, 1473694077, NULL, '{}'),
(3, 'iulianvultur@', '', 'test', 0, 1, 'Vultur Iulian', NULL, 1, 1473694077, NULL, '{}'),
(4, 'filipdimi@yahoo.com', '', '098f6bcd4621d373cade4e832627b4f6', 1, 1, 'Dimitrie Filip', 'profile/prof/filip_dimitrie.jpg', 1, 1473694077, 1476437110, '{ "statut": "Profesor", "spec": ["Informatică", "TIC"] }'),
(5, 'ilincaif@yahoo.com', '', 'test', 1, 0, 'Ilincăi Florin', 'profile/prof/ilincai_florin.jpg', 1, 1473694077, NULL, '{ "statut": "Profesor", "spec": ["Informatică", "TIC"] }'),
(6, 'test1@mail.com', '', 'test', 1, 0, 'Nechifor Elena Cristina', 'profile/prof/nechifor_cristina.jpg', 3, 1473694077, NULL, '{ "statut": "Director", "spec": ["Socio-Umane"] ,"grad":"I"}'),
(7, 'test2@mail.com', '', 'test', 1, 0, 'Tomescu Laurențiu', 'profile/prof/tomescu_laurentiu.jpg', 2, 1473694077, NULL, '{ "statut": "Director Adjunct", "spec": ["Ed. Fizică"],"grad":"I"}'),
(8, 'test@mail.com', '', 'test', 1, 0, '﻿Lemnariu Maria', 'profile/prof/lemnariu_maria.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(9, 'test@mail.com', '', 'test', 1, 0, 'Artenie Mariana', 'profile/prof/artenie_mariana.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(10, 'test@mail.com', '', 'test', 1, 0, 'Marcu Loredana', 'profile/prof/marcu_loredana.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(11, 'test@mail.com', '', 'test', 1, 0, 'Iacob Marius-Gabriel', 'profile/prof/iacob_marius.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I, doctor"}'),
(12, 'test@mail.com', '', 'test', 1, 0, 'Pavel Daniela', 'profile/prof/pavel_dana.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(13, 'test@mail.com', '', 'test', 1, 0, 'Sturzu Neculai', 'profile/prof/sturzu_neculai.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(14, 'test@mail.com', '', 'test', 1, 0, 'Bența Viorica', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba română"],"grad":"I"}'),
(15, 'test@mail.com', '', 'test', 1, 0, 'Rădulescu Liliana', 'profile/prof/radulescu_mihaela.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"doctor, I"}'),
(16, 'test@mail.com', '', 'test', 1, 0, 'Sturzu Virginia', 'profile/prof/sturzu_virginia.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"I"}'),
(17, 'test@mail.com', '', 'test', 1, 0, 'Ciofu Ioana', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"debutant"}'),
(18, 'test@mail.com', '', 'test', 1, 0, 'Rotăriţa Alina', 'profile/prof/rotarita_alina.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"II"}'),
(19, 'test@mail.com', '', 'test', 1, 0, 'Munteanu Carmen', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"II"}'),
(20, 'test@mail.com', '', 'test', 1, 0, 'Vîrvarei Daniela', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba franceză"],"grad":"I"}'),
(21, 'test@mail.com', '', 'test', 1, 0, 'Benţa Primăvara', 'profile/prof/benta_primavara.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba engleză"],"grad":"I"}'),
(22, 'test@mail.com', '', 'test', 1, 0, 'Ciubotaru Alina', 'profile/prof/ciubotariu_alina.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba engleză"],"grad":"II"}'),
(23, 'test@mail.com', '', 'test', 1, 0, 'Nistor Dorin', 'profile/prof/nistor_dorin.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba engleză"],"grad":"I"}'),
(24, 'test@mail.com', '', 'test', 1, 0, 'Anton Dana', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba engleză"],"grad":"I"}'),
(25, 'test@mail.com', '', 'test', 1, 0, 'Simion Ovidiu', '', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba germană"],"grad":"I"}'),
(26, 'test@mail.com', '', 'test', 1, 0, 'Nicolae Mihaela', 'profile/prof/neculaie_mihaela.jpg', 1, 1473694077, NULL, '{"statut":"profesor","spec":["Limba latină"],"grad":"II"}'),
(27, 'maxim.cezar@mail.com', '', '5f01bde976071a5a9989710e608adcd4', 0, 0, 'Cezar Maxim', NULL, 5, 1474446118, 1474446956, '{}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `catd_articles`
--
ALTER TABLE `catd_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catd_roles`
--
ALTER TABLE `catd_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catd_id` (`catd_id`);

--
-- Indexes for table `catds`
--
ALTER TABLE `catds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `static`
--
ALTER TABLE `static`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `catd_articles`
--
ALTER TABLE `catd_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `catd_roles`
--
ALTER TABLE `catd_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `catds`
--
ALTER TABLE `catds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `static`
--
ALTER TABLE `static`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
