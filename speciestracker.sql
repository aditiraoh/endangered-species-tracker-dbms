-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2024 at 04:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speciestracker`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLocationBySpeciesName` (IN `speciesName` VARCHAR(50))   BEGIN
    SELECT l.locationName, l.latitude, l.longitude 
    FROM location l 
    JOIN species s ON s.SpeciesID = l.SpeciesID 
    WHERE s.speciesName = speciesName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetSpeciesDetailsByName` (IN `speciesName` VARCHAR(50))   BEGIN
    SELECT ScientificName, Class, Orders, Family, Description 
    FROM Species 
    WHERE speciesName = speciesName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetSpeciesStatusAndObservationDateByName` (IN `speciesName` VARCHAR(100))   BEGIN
    SELECT cs.statusName, o.observationDate 
    FROM conservationStatus cs 
    JOIN observations o ON cs.speciesID = o.speciesID 
    WHERE cs.speciesID = (SELECT SpeciesID FROM species WHERE speciesName = speciesName LIMIT 1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `conservationstatus`
--

CREATE TABLE `conservationstatus` (
  `ConservationStatusID` varchar(5) NOT NULL,
  `StatusName` varchar(5) DEFAULT NULL,
  `SpeciesID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conservationstatus`
--

INSERT INTO `conservationstatus` (`ConservationStatusID`, `StatusName`, `SpeciesID`) VALUES
('C1', 'LC', 'S1'),
('C10', 'CR', 'S10'),
('C11', 'EN', 'S11'),
('C12', 'CR', 'S12'),
('C13', 'CR', 'S13'),
('C14', 'LC', 'S14'),
('C15', 'VU', 'S15'),
('C16', 'EN', 'S16'),
('C17', 'VU', 'S17'),
('C18', 'EN', 'S18'),
('C19', 'EN', 'S19'),
('C2', 'EN', 'S2'),
('C20', 'VU', 'S20'),
('C21', 'LC', 'S21'),
('C22', 'CR', 'S22'),
('C23', 'LC', 'S23'),
('C24', 'EN', 'S24'),
('C25', 'LC', 'S25'),
('C26', 'EN', 'S26'),
('C27', 'LC', 'S27'),
('C28', 'CR', 'S28'),
('C29', 'VU', 'S29'),
('C3', 'VU', 'S3'),
('C30', 'VU', 'S30'),
('C4', 'NT', 'S4'),
('C5', 'EN', 'S5'),
('C6', 'CR', 'S6'),
('C7', 'NT', 'S7'),
('C8', 'CR', 'S8'),
('C9', 'NT', 'S9');

--
-- Triggers `conservationstatus`
--
DELIMITER $$
CREATE TRIGGER `check_conservation_status` BEFORE UPDATE ON `conservationstatus` FOR EACH ROW BEGIN
    DECLARE valid_status BOOLEAN;

    -- Check if the new statusName matches the allowed values
    IF NEW.statusName IN ('LC', 'NT', 'VU', 'EN', 'CR', 'EX') THEN
        SET valid_status = TRUE;
    ELSE
        SET valid_status = FALSE;
    END IF;

    -- If statusName is not valid, prevent the update
    IF NOT valid_status THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid conservation status. Allowed values are LC, NT, VU, EN, CR, EX';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationID` varchar(5) NOT NULL,
  `LocationName` varchar(50) DEFAULT NULL,
  `Latitude` varchar(10) DEFAULT NULL,
  `Longitude` varchar(10) DEFAULT NULL,
  `SpeciesID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`, `Latitude`, `Longitude`, `SpeciesID`) VALUES
('L1', 'Nicobar islands', '7.1205° N', '93.7842° E', 'S1'),
('L10', 'Maharashtra', '17.43°N', '73.03°E', 'S10'),
('L11', 'Gujarat', '21.374° N', '73.7620° E', 'S11'),
('L12', 'West Bengal', '21.9497° N', '89.1833° E', 'S12'),
('L13', 'Madhya Pradesh', '26.3698° N', '78.8367° E', 'S13'),
('L14', 'Maharashtra', '20.5937° N', '78.9629° E', 'S14'),
('L15', 'Uttar Pradesh', '26.8467° N', '80.9462° E', 'S15'),
('L16', 'Karnataka', '13.6949° N', '75.6352° E', 'S16'),
('L17', 'Madhya Pradesh', '23.0707°N', '80.0982° E', 'S17'),
('L18', 'Assam', '26.2006° N', '92.9376° E', 'S18'),
('L19', 'Gujarat', '22.27°N', '73.20° E', 'S19'),
('L2', 'Bihar', '25.9644° N', '85.2722° E', 'S2'),
('L20', 'Arunachal Pradesh', '28.7313° N', '95.8987° E', 'S20'),
('L21', 'Maharashtra', '20.5937° N', '78.9629° E', 'S21'),
('L22', 'Andhra Pradesh', '15.4777° N', '78.4873° E', 'S22'),
('L23', 'Kerala', '10.1667° N', '77.0667° E', 'S23'),
('L24', 'Kerala', '11.0694° N', '76.4280° E', 'S24'),
('L25', 'Madhya Pradesh', '23.0707°N', '80.0982° E', 'S25'),
('L26', 'Assam', '26.8102° N', '91.2395° E', 'S26'),
('L27', 'Tamil Nadu', '12.9878° N', '80.2514° E', 'S27'),
('L28', 'West Bengal', '27.18°N', '88.56°E', 'S28'),
('L29', 'Uttar Pradesh', ' 26.8467° ', ' 80.9462° ', 'S29'),
('L3', 'Jammu Kashmir', '33.2778° N', '75.3412° E', 'S3'),
('L30', 'Arunachal Pradesh', '28.2180° N', '94.7278° E', 'S30'),
('L4', 'Uttarakhand', '29.4929° N', '79.3171° E', 'S4'),
('L5', 'Uttar Pradesh', '25.32° N', '83.11° E', 'S5'),
('L6', 'Uttar Pradesh', '26.4499°N', '80.3319°E', 'S6'),
('L7', 'Haryana', '29.0588° N', '76.0856° E', 'S7'),
('L8', 'Kerala', '11.2855° N', '76.2386° E', 'S8'),
('L9', 'Arunachal Pradesh', '28.2180° N', '94.7278° E', 'S9');

-- --------------------------------------------------------

--
-- Table structure for table `observations`
--

CREATE TABLE `observations` (
  `ObservationsID` varchar(5) NOT NULL,
  `SpeciesID` varchar(5) DEFAULT NULL,
  `LocationID` varchar(5) DEFAULT NULL,
  `ObservationDate` date DEFAULT NULL,
  `ConservationStatusID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `observations`
--

INSERT INTO `observations` (`ObservationsID`, `SpeciesID`, `LocationID`, `ObservationDate`, `ConservationStatusID`) VALUES
('Ob1', 'S1', 'L1', '2020-09-01', 'C1'),
('Ob10', 'S10', 'L10', '2010-07-03', 'C10'),
('Ob11', 'S11', 'L11', '2019-05-10', 'C11'),
('Ob12', 'S12', 'L12', '2018-03-14', 'C12'),
('Ob13', 'S13', 'L13', '2022-12-30', 'C13'),
('Ob14', 'S14', 'L14', '2018-10-31', 'C14'),
('Ob15', 'S15', 'L15', '2015-01-10', 'C15'),
('Ob16', 'S16', 'L16', '2019-09-18', 'C16'),
('Ob17', 'S17', 'L17', '2016-07-19', 'C17'),
('Ob18', 'S18', 'L18', '2016-05-12', 'C18'),
('Ob19', 'S19', 'L19', '2018-03-13', 'C19'),
('Ob2', 'S2', 'L2', '2018-03-14', 'C2'),
('Ob20', 'S20', 'L20', '2008-06-30', 'C20'),
('Ob21', 'S21', 'L21', '2021-02-18', 'C21'),
('Ob22', 'S22', 'L22', '2008-01-01', 'C22'),
('Ob23', 'S23', 'L23', '2016-01-27', 'C23'),
('Ob24', 'S24', 'L24', '2015-11-20', 'C24'),
('Ob25', 'S25', 'L25', '2014-08-15', 'C25'),
('Ob26', 'S26', 'L26', '2016-02-01', 'C26'),
('Ob27', 'S27', 'L27', '2019-09-08', 'C27'),
('Ob28', 'S28', 'L28', '2019-05-29', 'C28'),
('Ob29', 'S29', 'L29', '2018-12-06', 'C29'),
('Ob3', 'S3', 'L3', '2016-11-08', 'C3'),
('Ob30', 'S30', 'L30', '2016-03-17', 'C30'),
('Ob4', 'S4', 'L4', '2008-06-30', 'C4'),
('Ob5', 'S5', 'L5', '2021-08-01', 'C5'),
('Ob6', 'S6', 'L6', '2021-03-29', 'C6'),
('Ob7', 'S7', 'L7', '2018-08-05', 'C7'),
('Ob8', 'S8', 'L8', '2015-03-03', 'C8'),
('Ob9', 'S9', 'L9', '2015-04-11', 'C9');

--
-- Triggers `observations`
--
DELIMITER $$
CREATE TRIGGER `before_update_observation_date` BEFORE UPDATE ON `observations` FOR EACH ROW BEGIN
    DECLARE existing_date DATE;
    
    -- Retrieve the existing observation date for the SpeciesID being updated
    SELECT ObservationDate INTO existing_date
    FROM Observations
    WHERE SpeciesID = NEW.SpeciesID;
    
    -- Check if the new observation date is older than the existing date
    IF NEW.ObservationDate < existing_date THEN
        -- If the new date is older, raise an error
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'New observation date cannot be older than the existing date.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `observers`
--

CREATE TABLE `observers` (
  `ObserverID` varchar(5) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `observers`
--

INSERT INTO `observers` (`ObserverID`, `Username`, `password`) VALUES
('u1', 'admin1@est', 'adminest'),
('u2', 'admin2@est', 'adminest'),
('u3', 'abhay', '123'),
('u4', 'aditi', '123'),
('u5', 'panel', '123'),
('u6', 'exam', '123'),
('u7', 'yello', 'yello');

--
-- Triggers `observers`
--
DELIMITER $$
CREATE TRIGGER `before_insert_observer` BEFORE INSERT ON `observers` FOR EACH ROW BEGIN
    DECLARE username_count INT;
    
    -- Check if the new username already exists
    SELECT COUNT(*) INTO username_count
    FROM Observers
    WHERE Username = NEW.Username;
    
    -- If the username already exists, raise an error
    IF username_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Username already exists';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `SpeciesName` varchar(50) DEFAULT NULL,
  `ScientificName` varchar(50) DEFAULT NULL,
  `SpeciesID` varchar(5) NOT NULL,
  `Class` varchar(50) DEFAULT NULL,
  `Orders` varchar(50) DEFAULT NULL,
  `Family` varchar(50) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `ConservationStatusID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`SpeciesName`, `ScientificName`, `SpeciesID`, `Class`, `Orders`, `Family`, `Description`, `ConservationStatusID`) VALUES
('Reticulated python', 'Malayopython reticulatus', 'S1', 'Reptilia', 'Squamata', 'Pythonidae', 'The species occurs in rainforest, woodland and adjacent grassland areas. It is also associated with rivers and is often found near or in streams and lakes. Being the worlds longest snake, the species is often persecuted out of fear. The species is hunted primarily for skins, but also for food, traditional medicine and pets in most of its range. These snakes are hunted for meat for domestic markets. This species is an excellent swimmer.', 'C1'),
('Deccan barb ', ' Puntius deccanensis ', 'S10', ' Actinopetrygii ', ' Cypriniformes ', ' Cyprinidae ', 'Puntius deccanensis is endemic to the northern Western Ghats. The upper lake is affected by domestic waste and detergents, and organic pollution. The lower lake is inside a snake park, but the run-off from the upper lake may have some impact on the lower lake. There is a need to determine the taxonomic validity of the species as well as its distribution and population status.', 'C10'),
('Indian Pangolin', ' Manis crassicaudata ', 'S11', ' Mammalia ', ' Pholidota ', ' Manidae ', 'This species is distributed in South Asia from northern and southeastern Pakistan through much of India south of the Himalayas. The Indian Pangolin is primarily threatened by overexploitation including hunting and poaching for both its meat and scales which are used and consumed at a local, subsistence level, but increasingly for illegal international trade. Its meat is consumed as a source of protein locally and its scales have been used in whole or powdered form in the preparation of traditional medicines and as curios in Pakistan.', 'C11'),
('Northern River Terrapin ', '  Batagur Baska', 'S12', ' Reptilia ', ' Testudines ', ' Geoemydidae ', 'Batagur baska once ranged from Orissa and West Bengal in India through Bangladesh and Myanmar. It is now limited to the Sundabans area of India and Bangladesh, with three females in two different temple ponds in Myanmar. Batagur baska has been exploited long-term for local subsistence and ritualistic consumption as well as some regional trade, including supply to the Calcutta markets in the 19th and 20th centuries. Harvest of its eggs has been extensive as the eggs are highly prized for consumption and can be collected at known sites at predictable times.', 'C12'),
('Gharial ', '  Gavialis Gangeticus ', 'S13', ' Reptilia ', ' Crocodylia ', ' Gavialidae ', 'The species is now limited to only 14 widely spaced, restricted localities in north India. Five subpopulations [Chambal River, Katerniaghat Reservoir (on Girwa River), Chitwan National Park (Nepal), Corbett National Park and Gandak River] exhibit recent reproduction/recruitment. Major water control structures, including dams, barrages (=low, gated diversion dams) and related constructions, have been detrimental to gharial distribution and abundance on all of the river drainages in which the species occurred. These structures resulted in serious habitat fragmentation and degradation.', 'C13'),
('Great False Vampire Bat ', '  Lyroderma Iyra ', 'S14', ' Mammalia ', ' Chiroptera ', ' Megadermatidae ', 'This very widely recorded species ranges through much of South Asia, southern and Central China, and throughout the Southeast Asian mainland. This species is found in variety of habitats ranging from dry arid lands to hot humid forests to coastal areas. There appear to be no major threats to this species as a whole. It is locally threatened in parts of its range due to disturbance and loss of roosting sites due to renovation of old temples, buildings and old forts. Populations are also threatened by mining activities and hunting for local consumption (medicine and food) in India and Viet Nam.', 'C14'),
('Barasingha ', '  Rucervus duvauceli ', 'S15', ' Mammalia ', ' Artiodactyla ', ' Cervidae ', 'The Barasingha is currently found in isolated localities in north and central India, and southwestern Nepal. It is extinct in Pakistan and Bangladesh. It is likely that Barasingha always had a patchy distribution, reflecting the available suitable habitat, and thus was predisposed to local extermination (Groves 1982). In aggregate, habitat conversion has led to its loss from most of its ancestral range. High levels of malaria discouraged settlement, agriculture and thus habitat conversion in the Terai Arc Landscape until recently.', 'C15'),
('Asian Elephant ', '  Elephas maximus ', 'S16', ' Mammalia ', ' proboscidea ', ' Elephantidae ', 'Asian Elephants formerly ranged from West Asia along the Iranian coast into the Indian subcontinent, eastwards into South-east Asia including Sumatra, Java, and Borneo, and into China at least as far as the Yangtze-Kiang. As of 2018, population size estimates collated across all range countries, suggest a global Asian Elephant abundance of 48,323–51,680 individuals in the wild. Poaching is a major threat to elephants in Asia, although reliable estimates of the number of elephants killed and the quantities of ivory and other body parts collected and traded are scarce.', 'C16'),
('Four-horned antelope ', '  Tetracerus quadricoris ', 'S17', ' Mammalia ', ' Artiodactyla ', ' Bovidae ', 'Four-horned Antelopes are restricted to forest habitats and grassland margins, and mostly occur in open, dry deciduous mixed forests in undulating or hilly areas and never far from water, they are solitary and browse and graze. The major threat to the species is habitat destruction, through the clearance of scrub and forest for agriculture.', 'C17'),
('Wild Water Buffalo ', '  Bubalus arnee ', 'S18', ' Mammalia ', ' Artiodactyla ', ' Bovidae ', 'Wild Water Buffalo is very dependent on the availability of water and historically its preferred habitats were low-lying alluvial grasslands. It is listed as endangered and an inferred population reduction of at least 50% over the last three generations (generation length estimated at 8–10 years) seems likely given the severity of the threats.', 'C18'),
('Indian Softshell Turtle ', '  Nilssonia gangetica ', 'S19', ' reptilia ', ' testudines ', ' trionychidae ', 'Traditionally considered one of the most widespread and common turtle species in India, Nilssonia gangetica has been exploited intensively in recent years, mainly for export (meat and calipee) to East Asia as well as local consumption. Indications are that populations show an ongoing drastic decline amounting to over 50% over three generations (generation length a minimum of 25 years), qualifying the species as Endangered. Nilssonia gangetica inhabits mostly rivers, and large canals, preferably with turbid water, muddy bottom and some current. Lakes, oxbows, ponds and temporary waterbodies are used occasionally.', 'C19'),
('Tricarinate Hill Turtle', 'Melanochelys tricarinata', 'S2', 'Reptilia', 'Testudines', 'Geomydidae', 'Tricarinate Hill Turtle inhabits the Himalayan foothill from western Uttar Pradesh to Arunachal Pradesh of northern and northeastern India Habitat destruction and exploitation for subsistence consumption have been recorded in the eastern part of the range. This is apparently the species of choice for the manufacture of curio masks widely sold in tourist and craft markets in South and locally in Southeast Asia.', 'C2'),
('Takin ', '  Budorcas taxicolor ', 'S20', ' Mammalia ', ' Artiodactyla ', ' Bovidae ', 'This species occurs in Bhutan, China (southeastern Gansu, Sichuan, Shaanxi, southeast Tibet, and northwestern Yunnan), and northeast India and northern Myanmar. They feed on a variety of grasses, bamboo shoots, forbs and leaves of shrubs and trees. Taking forage in early morning and late afternoon, and regularly visit salt-licks which renders them very vulnerable to poachers who lay in ambush. The species is listed as Vulnerable A2cd based on a probable decline of at least 30% over the last three generations (estimated at 24 years) due to over-hunting and habitat loss.', 'C20'),
('Indian bullfrog ', '  Hoplobatrachus tigernius ', 'S21', ' Amphibia ', ' Anura ', ' Dicroglossidae ', 'Listed as Least Concern in view of its wide distribution, tolerance of a broad range of habitats, and presumed large and stable population. At present the species is considered to be locally common throughout much of its South Asian range. The conversion of wetland habitats through residential and commercial infrastructure development and their degradation by agrochemicals and urban waste are now the main threats to the species.', 'C21'),
('Peacock tarantula ', '  poecilotheria metallica ', 'S22', ' Archnida ', ' Araneae ', ' Theraphosidae ', 'The habitat where the species occurs is completely degraded due to lopping for firewood and cutting for timber. The habitat is under intense pressure from the surrounding villages as well as from insurgents who use forest resources for their existence and operations. It is assumed that the area of habitat has decreased over the years, but there is definitely a decline in quality of habitat for the spiders who seek cavities and deep crevices in old growth forests.The species is found in a single location, which is severely fragmented. The extent of occurrence is less than 100 km2. India: Andhra Pradesh: Reserve forest between Nandyal and Giddalur.', 'C22'),
('Giant Indian Squirrel ', '  Ratufa indica ', 'S23', ' Mammalia ', ' Rodentia ', ' Sciuridae ', 'This species is listed as Least Concern because of its wide distribution, presumed large population, occurrence in a number of protected areas, and it is unlikely to be declining at nearly the rate required to qualify for listing in a threatened category. Fairly common to locally common in areas where it occurs. Local extinctions and range restrictions have occurred, the current population is fragmented and remains in areas with limited suitable habitat It is a diurnal and arboreal species. It occurs in tropical evergreen, semievergreen and moist deciduous forests. The species is not tolerant of habitat degradation and does not occur in plantations.', 'C23'),
('Lion-tailed Macaque ', '  Macaca silenus ', 'S24', ' Mammalia ', ' Primates ', ' Cercopithecidae ', 'Lion-tailed Macaque is listed as Endangered as the total number of mature individuals is less than 2,500, with no subpopulation having more than 250 mature individuals. There are estimates of a continued decline of over 20% of the populations in the next approximately 25 years, along with hunting, road kills and continued loss of habitat. The total wild population is estimated to be about 4,000 individuals, made up of 47 isolated subpopulations in seven different locations; these subpopulations tend to be small and in forest fragments that are isolated from each other. Mainly arboreal, this species prefers the upper canopy of primary tropical evergreen rainforest.', 'C24'),
('Asian Chameleon ', '  Chamaeleo zeylanicus', 'S25', ' Repilia ', ' Squamata ', ' Chamaeleonidae ', 'Chamaeleo zeylanicus is listed as Least Concern as it is widely distributed, it occurs in several protected areas and the current threats are not causing major declines at present. It is found in scrublands, dry deciduous and secondary forests. It ranges into desert areas, but is restricted to oases in these habitats. This species is used for medicinal purposes, as it is traditionally believed to have curative properties in India.', 'C25'),
('Pygmy Hog ', '  Porcula salvania ', 'S26', ' Mammalia ', ' Artiodactyla ', ' Suidae ', 'The Pygmy Hog was listed as Critically Endangered in view of its small population (<250 estimated mature individuals among 200–500 total individuals) and its demographic decline caused by the exploitation of its habitat. Since then, the species has undergone several reintroductions that have presumably reversed its declining trend, but no data are currently available to quantify the effect of these conservation initiatives. Today, this species is on the brink of extinction, as only a few isolated and small subpopulations survive in the wild.', 'C26'),
('Pondichery Fan Throated Lizard ', '  Sitana Ponticeriana ', 'S27', ' Reptilia ', ' Squamata ', ' Agamidae ', 'This species is restricted to the east coast and adjacent areas of India (Deepak and Kharanth 2018). A record from Hiniduma in Sri Lankas wet zone, described as the subspecies Sitana ponticeriana mucronata, may represent a misidentification (Bahir and Silva 2005) and no members of this genus have since been recorded from this locality. There are no data on population size and trends for this species. It is common and its population is presumed stable.', 'C27'),
('Sumatran Rhinoceros ', '  Dicerorhinus sumatrensis ', 'S28', ' Mammalia ', ' Perissodactyla ', ' Rhinocerotidae ', 'Sumatran Rhinos have declined significantly across their range in the past 30 years, with populations lost in Peninsular Malaysia, the State of Sabah, Malaysia, and in Kerinci Seblat National Park in Indonesia. This species is listed as Critically Endangered due to very severe past declines of greater than 80% over three generations.The cause of the decline is inferred to be poaching, habitat fragmentation, human disturbance, and habitat loss due to encroachment. We estimate that the probability of extinction in 3 generations (60 years) is 90%, without successful interventions.', 'C28'),
('Greater one-horned Rhino ', '  Rhinoceros unicornis ', 'S29', ' Mammalia ', ' Perissodactyla ', ' Rhinocerotidae ', 'The Greater One-horned Rhinoceros declined to near extinction by the early 20th century due to habitat loss and poaching, and it is still threatened by habitat loss, poaching, and human-wildlife conflict. The main cause of habitat loss is the conversion of grasslands to cropland, plantations, and settlements. Poaching for its horn stopped by the early 1990s, thanks to the Indian Rhino Vision 2020 program, the population has increased to around 3,700.', 'C29'),
('Snow Leopard', 'Panthera Uncia', 'S3', 'Mammalia', 'Carnivora', 'Falidae', 'The Snow Leopard is assessed as Vulnerable because the global population is estimated to number more than 2,500 but fewer than 10,000 mature individuals, and there is an estimated and projected decline of at least 10% over 22.62 years (3 generations). The range of the Snow Leopard extends from the Himalaya in the south, across the Qinghai-Tibet Plateau and the mountains of Central Asia to the mountains of southern Siberia in the north. Poaching and illegal trade has been a traditional threat and continues in many parts of the range. Currently, the demand for rugs, luxury décor, and taxidermy, especially from China and Eastern Europe appears on the increase.', 'C3'),
('Asiatic Black Bear', '  Ursus thibetanus ', 'S30', ' Mammalia ', ' Carnivora ', ' Ursidae ', 'The habitat is a rocky outcrop with little vegetation and small permanent pools. The location is currently experiencing severe habitat decline due to deforestation for subsistence agriculture and illegal wood collection. The species is also threatened by ongoing land development for housing, roads, and other infrastructure. The extent of occurrence is less than 10 km2. The habitat quality and the population size and structure are declining.', 'C30'),
('Himalayan Goral', ' Naemorhedus goral', 'S4', 'Mammalia', 'Artidoctyla', 'Bovidae', 'The Himalayan goral is found across the Himalayas including Bhutan, China (southern Tibet), northern India (including Sikkim), Nepal, and northern Pakistan. n India, densities have been variously estimated: 2.6/km² in Kedarnath Sanctuary in Uttaranchal (Green 1987a), 1.2/km² in Daranghati Sanctuary, 1.5/km² in Rupi Bhaba Sanctuary, and 4.6 to 10.5/km² in Majathal Harsang Wildlife Sanctuary. The main threats come from habitat destruction, hunting, and possibly from competition with livestock.', 'C4'),
(' Ganges River Dolphin', ' Platanista gangetica', 'S5', 'Mammalia', 'Artiodactyla', 'Platanistidae', 'Ganges River Dolphins are generally concentrated in counter-current pools below channel convergences and sharp meanders and above and below mid-channel islands, bridge pilings, and other engineering structures that cause scouring.Major threats to Ganges River Dolphins include 1) flow regulation and habitat fragmentation by water development projects (dams, barrages, canals, and embankment construction projects), 2) mortality from entanglement in fishing nets, 3) targeted hunting of dolphins for oil and flesh, 4) river pollution, and 5) disturbance from human activities related to boat traffic, underwater noise, and shoreline/riverfront development.', 'C5'),
(' Pinniwallago catfish', ' Pinniwallago Kanpurensis', 'S6', 'Actinopterygii', 'Siluriformes', 'Siluridae', 'Pinniwallago kanpurensis is only known from a small lakeBara Tal near village of Bhitargaon, Kanpur, Uttar Pradesh, India. The quality of the habitat has drastically declined due to anthropogenic activities as it is situated next to a densely populated village and is surrounded by agricultural fields both of which have resulted in significant pollution. These threats are thought to be continuing.', 'C6'),
(' Himalayan Golden Mahseer', ' Tor putitora', 'S7', 'Actinopterygii', 'Cypriniformes', 'Cyprinidae', 'Tor putitora is naturally distributed throughout the rivers (and associated reservoirs) of the South Himalayan drainage (namely the Indus, Ganges-Yamuna and Bramaputra). A range of anthropogenic impacts, the most significant of which is habitat loss and degradation due to the large number of existing and planned hydropower projects in the Himalayan range, has affected the past and continued survival of the golden mahseer. Other threats include overfishing, often using unsustainable methods (dynamiting, poisoning and use of fine-meshed nets), and pollution from both urban and agro-based sources are also significant stressors.', 'C7'),
(' Malabar Civet', ' Viverra civettina', 'S8', ' Mammalia ', ' Carnivora ', ' Viverridae ', 'Malabar Civet is believed to be endemic to the Western Ghats of southern India. Assuming habitat use similar to that of Large-spotted Civet, Malabar Civet is likely to have undergone a massive decline a century ago because of extensive conversion of forest to agriculture. Coastal plain forest was never extensive in its presumed range because the Western Ghats hill range run quite close to the coast along its length.', 'C8'),
('Red Panda', 'Ailurus Fulgens', 'S9', 'Mammalia', 'Carnivora', 'Ailuridae', 'In India it is found in only three states: Sikkim, West Bengal and Arunachal Pradesh. Red Panda is largely vegetarian, eating chiefly young leaves and shoots of bamboo. It also takes fruit, roots, succulent grasses, acorns, lichens, birds eggs and insects. It is largely arboreal. The major threats are habitat loss and fragmentation, habitat degradation, and physical threats. These are all compounded by the region\'s increasing human population, climate change, natural disasters, inadequate enforcement of laws and regulations, mostly low political will and interest, political instability.', 'C9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conservationstatus`
--
ALTER TABLE `conservationstatus`
  ADD PRIMARY KEY (`ConservationStatusID`),
  ADD KEY `SpeciesID` (`SpeciesID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`),
  ADD KEY `SpeciesID` (`SpeciesID`);

--
-- Indexes for table `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`ObservationsID`),
  ADD KEY `SpeciesID` (`SpeciesID`),
  ADD KEY `LocationID` (`LocationID`),
  ADD KEY `ConservationStatusID` (`ConservationStatusID`);

--
-- Indexes for table `observers`
--
ALTER TABLE `observers`
  ADD PRIMARY KEY (`ObserverID`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`SpeciesID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conservationstatus`
--
ALTER TABLE `conservationstatus`
  ADD CONSTRAINT `conservationstatus_ibfk_1` FOREIGN KEY (`SpeciesID`) REFERENCES `species` (`SpeciesID`) ON DELETE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`SpeciesID`) REFERENCES `species` (`SpeciesID`) ON DELETE CASCADE;

--
-- Constraints for table `observations`
--
ALTER TABLE `observations`
  ADD CONSTRAINT `observations_ibfk_1` FOREIGN KEY (`SpeciesID`) REFERENCES `species` (`SpeciesID`) ON DELETE CASCADE,
  ADD CONSTRAINT `observations_ibfk_2` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`) ON DELETE CASCADE,
  ADD CONSTRAINT `observations_ibfk_3` FOREIGN KEY (`ConservationStatusID`) REFERENCES `conservationstatus` (`ConservationStatusID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
