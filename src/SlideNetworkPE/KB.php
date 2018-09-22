<?php
 namespace SlideNetworkPE;
 
 use pocketmine\plugin\PluginBase;
 use pocketmine\event\Listener;
 use pocketmine\event\entity\EntityDamageEvent;
 use pocketmine\event\entity\EntityDamageByEntityEvent;
 use pocketmine\command\CommandSender;
 use pocketmine\command\Command;
 
 class KB extends PluginBase implements Listener{
     public $default = 2.0;
     public function onEnable() {
         $this->saveDefaultConfig();
         $this->getServer()->getPluginManager()->registerEvents($this, $this);
         $this->getLogger()->info("§anow enabled!");
     }
     public function knockBack(EntityDamageEvent $event){
         if($event instanceof EntityDamageByEntityEvent){
             $event->setKnockBack($this->getConfig()->get("knockback"));
         }
     }

     public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
     {
         switch ($cmd->getName()) {
             case "knockback":
                 if (!in_array(strtolower($args[0]), array("set", "help", "default"))) {
                     $sender->sendMessage('§9 The argument called§f: "' . $args[0] . '" §9dont exist, Try §f/kb help§9 to more information');
                     return true;
                 }
                 if (!isset($args[0])) {
                     $sender->sendMessage('§9No args, use §f/knockback help §9for more information');
                     return true;
                 } else if (count($args) > 0) {
                     switch ($args[0]) {
                         case "help":
                             $sender->sendMessage("§6 Avaliable command with args:");
                             $sender->sendMessage("§7Format: §5 <command>   <args>   <more args xd>");
                             $sender->sendMessage("§7-  §9/knockback set <amount>§f: Set the amount of the knockback.");
                             $sender->sendMessage("§7-  §9/knockback actual§f: Shows you the actual amount of knockback.");
                             $sender->sendMessage("§7-  §9/knockback default§f: Sets the default amount of knockback");
                             break;

                         case "default":
                             $sender->sendMessage("to do xd");
                             break;

                         case "set":
                             if (isset($args[1])) {
                                 $jaja = $args[1];
                                 if (is_numeric($jaja)) {
                                     $this->getConfig()->remove("knockback");
                                     $this->getConfig()->setNested("knockback", $jaja);
                                     $this->saveConfig();
                                     $sender->sendMessage('§a Now the knockback value is§f: ' . $jaja);
                                 } else {
                                     $sender->sendMessage("is_numeric: false");
                                     return true;
                                 }
                             }
                     }
                 }

         }
         return true;
     }
 }