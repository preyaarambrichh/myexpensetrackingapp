-- Date Database created:19/12/2021
-- Server version: 5.6.21
-- PHP Version: 5.6.3
-- Database Name: `dailyexpense`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--************************************************************************************************************

-- Table for `expenses`

CREATE TABLE `expenses` (
  `expense_id` int(20) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `expense` int(20) NOT NULL,
  `expensedate` varchar(15) NOT NULL,
  `expensecategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--************************************************************************************************************

-- Table for `users`

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_path` varchar(50) NOT NULL DEFAULT 'avatar.png',
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Indexes for table `expenses`

ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);


-- Indexes for table `users`

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);


-- AUTO_INCREMENT for table `expenses`

ALTER TABLE `expenses`
  MODIFY `expense_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;


-- AUTO_INCREMENT for table `users`

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
