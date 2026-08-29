-- =============================================
-- E-Commerce Database Schema
-- Database: ecommerce_db
-- =============================================

CREATE DATABASE IF NOT EXISTS `ecommerce_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ecommerce_db`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('customer', 'admin') DEFAULT 'customer',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `image` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT NULL,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT NOT NULL DEFAULT 0,
    `image` VARCHAR(255) NULL,
    `featured` TINYINT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NULL,
    `customer_name` VARCHAR(150) NOT NULL,
    `customer_email` VARCHAR(150) NOT NULL,
    `customer_address` TEXT NOT NULL,
    `total_amount` DECIMAL(10, 2) NOT NULL,
    `payment_method` VARCHAR(50) DEFAULT 'cod',
    `status` ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `order_items`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity` INT NOT NULL,
    `total` DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Sample Data for KALATIVE Artisanal Home Collection
-- --------------------------------------------------------
INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Vases & Vessels', 'vases-vessels'),
(2, 'Heritage Lighting', 'heritage-lighting'),
(3, 'Architectural Mirrors', 'architectural-mirrors'),
(4, 'Ceramic Objects', 'ceramic-objects'),
(5, 'Royal Living', 'royal-living')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `slug`=VALUES(`slug`);

INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `description`, `price`, `stock`, `image`, `featured`) VALUES
(1, 1, 'Sculptural Vases', 'sculptural-vases', 'Handcrafted wabi-sabi terracotta urn with artisanal rustic finish, embodying timeless clay craftsmanship.', 4500.00, 20, 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=800&q=80', 1),
(2, 2, 'Heritage Lamps', 'heritage-lamps', 'Warm brushed antique brass table lamp designed with architectural poise and ambient golden illumination.', 12000.00, 15, 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=800&q=80', 1),
(3, 3, 'Arched Mirrors', 'arched-mirrors', 'Grand arched silhouette mirror crafted with hand-forged antique iron and regal haveli proportions.', 8900.00, 8, 'https://images.unsplash.com/photo-1618221381711-42ca8ab6e908?auto=format&fit=crop&w=800&q=80', 1),
(4, 4, 'Ceramic Objects', 'ceramic-objects', 'Set of minimalist stoneware artisanal vessels and organic decorative bowls finished in matte alabaster glazes.', 2200.00, 30, 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=800&q=80', 1),
(5, 5, 'Royal Haveli Settee', 'royal-haveli-settee', 'Bespoke hand-carved teakwood settee upholstered in rich heritage rust velvet with antique brass accents.', 68000.00, 5, 'https://images.unsplash.com/photo-1617806118233-18e1de247200?auto=format&fit=crop&w=1200&q=80', 0),
(6, 1, 'Fluted Stone Vessel', 'fluted-stone-vessel', 'Sculpted natural sandstone vessel with organic fluted texture, perfect for dried botanical arrangements.', 5800.00, 12, 'https://images.unsplash.com/photo-1594913785162-e678a0c23ccb?auto=format&fit=crop&w=800&q=80', 0),
(7, 5, 'Carved Teakwood Table', 'carved-teakwood-table', 'Handcrafted solid teakwood coffee table with organic fluted profile and natural matte beeswax polish.', 38500.00, 7, 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&w=800&q=80', 0),
(8, 2, 'Alabaster Pendant Lamp', 'alabaster-pendant-lamp', 'Natural translucent alabaster stone globe with aged brass chain fitting for ethereal ambient dining glow.', 16800.00, 10, 'https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?auto=format&fit=crop&w=800&q=80', 0),
(9, 4, 'Hand-Forged Brass Urli', 'hand-forged-brass-urli', 'Traditional hand-hammered raw brass urli vessel finished with satin oxidation for floating blossoms.', 6400.00, 25, 'https://images.unsplash.com/photo-1615529182904-14819c35db37?auto=format&fit=crop&w=800&q=80', 0),
(10, 3, 'Haveli Jharokha Mirror', 'haveli-jharokha-mirror', 'Intricately carved architectural mirror frame inspired by Rajasthani palace lattice stone balconies.', 32000.00, 6, 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=800&q=80', 0),
(11, 5, 'Hand-Woven Dhurrie Rug', 'hand-woven-dhurrie-rug', 'Heritage flat-weave wool dhurrie in organic oat and terracotta geometric motifs, handloomed by master weavers.', 22500.00, 9, 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=800&q=80', 0),
(12, 5, 'Monolithic Stone Table', 'monolithic-stone-table', 'Chiseled beige sandstone sculptural side pedestal celebrating the raw mineral weight of the Aravalli hills.', 29000.00, 8, 'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?auto=format&fit=crop&w=800&q=80', 0)
ON DUPLICATE KEY UPDATE `title`=VALUES(`title`), `slug`=VALUES(`slug`), `description`=VALUES(`description`), `price`=VALUES(`price`), `image`=VALUES(`image`), `featured`=VALUES(`featured`);
