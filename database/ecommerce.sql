-- Kalative - A Curation by Rangrez Database Schema
-- Database: kalactive_db

CREATE DATABASE IF NOT EXISTS `kalactive_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kalactive_db`;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `users`;

-- Table structure for `users`
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('customer', 'admin') DEFAULT 'customer',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for `categories`
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `image` VARCHAR(500) DEFAULT '',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for `products`
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `old_price` DECIMAL(10,2) NULL,
  `stock` INT NOT NULL DEFAULT 0,
  `image` VARCHAR(500) DEFAULT '',
  `badge` VARCHAR(50) DEFAULT '',
  `rating` DECIMAL(2,1) DEFAULT 5.0,
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for `orders`
CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NULL,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `shipping_name` VARCHAR(100) NOT NULL,
  `shipping_email` VARCHAR(150) NOT NULL,
  `shipping_address` TEXT NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `zip_code` VARCHAR(20) NOT NULL,
  `payment_method` VARCHAR(50) DEFAULT 'Cash on Delivery',
  `payment_status` ENUM('Pending', 'Paid', 'Failed') DEFAULT 'Pending',
  `order_status` ENUM('Processing', 'Shipped', 'Delivered', 'Cancelled') DEFAULT 'Processing',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for `order_items`
CREATE TABLE `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Seed Data for Kalative - Royal Curation

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`) VALUES
(1, 'Admin User', 'admin@kalactive.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1T6S6KxG64A5xXf0.a1H7QJ/pU3D4kO', 'admin');

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`) VALUES
(1, 'Royal Edit', 'royal-edit', 'Objects inspired by Indian craft, colour and quiet extravagance.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCPZabbBWyH2QZAvTlkjMGUvOjXtoJiFb-ApmF0IxLCCUyThcocDFVe3YM54TfBkaSE_M1Ct2oYN1VqMH6gwDEsClKoD3D-TywyeD6RSCYfNq8M6J6PjUsuQPE0u7BMkAPgOJm9oHh9-C0CmakWDbzhS9xGCIDoKDryb7n2y8VhMhPrMbNdfzeIkNDNtE9l4RtoWsJ6-bLxvC1ePyYxRLUwBeBewWV2q5Me76KOuDMR1tRYhHmVLts'),
(2, 'Earthed', 'earthed', 'Tactile ceramic forms, natural unglazed pottery and raw clay silhouettes.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBvPxqqiAOJba4inwMuFfbGcDBifewVm1LZxL4hWk84YEQoqKgWsMje7Xu6cL_x5kYTvum2Zgf1ArLMzUeNMDlENRSYXwS5vZp1zAyugiVxEmbxCWbMQ5C2nrljVi2HughPqI2P_69JRRfIqWI1EzpRSg_8hnirogKTsapkLaarkk06EHPuQi-iUGkr2hzFy_QTEUYsOphlq0cCQ0oOW3TxOr4a04U3bgCSB5Z6vWsW-WreS1tXosM'),
(3, 'Playful', 'playful', 'Vibrant ochre and deep indigo accents celebrating joyful traditional motifs.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuB-VyD121SBKntKa0Kmmy363Hbhq6gG1bcYusVJMdf-FuZOo1t9Nl5qzQeFuW8c0iOnvzVMpOc_f-0-LsmpT_5mUqY0_tgLJd5QlYMP5xe2lFUJQv4ogFyws5OtSFMvRm5KHCaEB9WlodML9ChH54x-wH2Rgbl3tuFifRb3DCxdRixG43Q0lu-p_KOVTYkyD00A7KvxTM4xr4xibIZtnxDqvgmKl4N_n_Ne3q1bsoTUcb3SKuqFk4I'),
(4, 'Timeless', 'timeless', 'Polished dark teak furniture, hand-carved mirrors and brass heirlooms.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcGKQiwDv52Qvv61A9no9kw0_hOHzy6sldasRRmJonJyHguMgDTRCvp6qrNrGxf9EooWaHNwuKcsQD55xpVc16-1H7J9cHcHk9qspkxQzawaD2c6yMGaMrkrO6lwXLpnbwGGLAvcznNjLX0oyaLWeULhuuDQTnndjDEr93WS8LATf6c-OF41PGACQRb3x2LEi4or_urc-FD8ZUEeAUuKo6lE_U-hk1ITRDX7GlZ3DE013zUcfKwGY');

INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `description`, `price`, `old_price`, `stock`, `image`, `badge`, `rating`, `is_featured`) VALUES
(1, 1, 'Sculptural Vases', 'sculptural-vases', 'Hand-molded terracotta sculptural vase with tactile matte cream finish.', 4500.00, NULL, 20, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCPZabbBWyH2QZAvTlkjMGUvOjXtoJiFb-ApmF0IxLCCUyThcocDFVe3YM54TfBkaSE_M1Ct2oYN1VqMH6gwDEsClKoD3D-TywyeD6RSCYfNq8M6J6PjUsuQPE0u7BMkAPgOJm9oHh9-C0CmakWDbzhS9xGCIDoKDryb7n2y8VhMhPrMbNdfzeIkNDNtE9l4RtoWsJ6-bLxvC1ePyYxRLUwBeBewWV2q5Me76KOuDMR1tRYhHmVLts', 'NEW', 5.0, 1),
(2, 1, 'Heritage Lamps', 'heritage-lamps', 'Handcrafted antique brass table lamp with warm ambient glow.', 12000.00, NULL, 12, 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1UCv6L4GGjoWS0S10rXAH04RIa7eU6P52s6Vg-NAETMB5imUDAPhYVYeQ7omCQ2O4gKVauD_MSPDUn9cQeJFRyqFDaUxxJSwRr9Av-CRIpMyS3rfn-nJsAhv46TJ_9N2CUu0O9KpD99A4PypOP44jrhsfi4Haeg9mMAMlhiOQHWxXVxbX-CiUVRQDFuLfjECCxfIvY44NfL3uioRRnVo6L9zEDS3BK5iDLyRCakQCzXn3lMIw5oo', '', 4.9, 1),
(3, 4, 'Arched Mirrors', 'arched-mirrors', 'Rajasthani haveli-inspired arched wall mirror framed in solid aged teak.', 8900.00, NULL, 15, 'https://lh3.googleusercontent.com/aida-public/AB6AXuD38KwQGly2Hs4r6YPKfJ8yqS6xpVh_2oW5H3N4m9KUoGVt1dTqf84xQaJJtevwBfcIr8ppe4HTD7d3ZhPZWhGZ1jBfqVkriVFnvQyxIbRBgMhtwydUKJhAtmoV7wyoO2QnZsNTGHQz892lp4pNA_GPEAeIT1dJGF4OAr4POod0josM8cpbNOCOvElVmlYTY75rkyvZyiTqmLafef1CddI88AQ5J_h6zI7wYNBHva8mPbwF5-AWCX0', '', 4.8, 1),
(4, 2, 'Ceramic Objects', 'ceramic-objects', 'Set of four artisanal ceramic vessels crafted by master Indian potters.', 2200.00, 2800.00, 30, 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWp4mSba07Vk46zA5Ixpen70m-URW4ZydPQrWVrC2TZmDodufBUDG81rv0SrR8pOEqzncLSExsFpU8vRhOCd7E_2Y73r3i7TLaJIX611ofOHY2dZP3-9UpWBT6CX4bCXKMK-yPJLVEoe4ezexvWAVIDlmq67kcKzVJzzYmF-qFcAzeifuZdtvDDw6lZb4aa6BAywqN8yKeZAGyxQ8D6QTxPMuBpYRicltC0sMMFdo97Fs_AU9omIs', 'LIMITED', 5.0, 1);
