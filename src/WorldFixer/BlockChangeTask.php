<?php

namespace WorldFixer;

use pocketmine\item\Item;
use pocketmine\level\format\Chunk;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class BlockChangeTask extends AsyncTask{

    private $chunks;
    private $pos1;
    private $pos2;
    private $levelId;
    private $chunkClass;

    private $color;
    private $slabs;

    public function __construct(array $chunks, Vector3 $pos1, Vector3 $pos2, $levelId, $chunkClass, $slabs = true, $color = true){
        $this->chunks = serialize($chunks);
        $this->pos1 = $pos1;
        $this->pos2 = $pos2;
        $this->levelId = $levelId;
        $this->chunkClass = $chunkClass;
        $this->slabs = $slabs;
        $this->color = $color;
    }

    public function onRun(){
        $chunkClass = $this->chunkClass;
        /** @var  Chunk[] $chunks */
        $chunks = unserialize($this->chunks);
        foreach($chunks as $hash => $binary){
            $chunks[$hash] = $chunkClass::fromBinary($binary);
        }

        for($x = $this->pos1->x; $x <= $this->pos2->x; $x++){
            for($z = $this->pos1->z; $z <= $this->pos2->z; $z++){
                $hash = Level::chunkHash($x >> 4, $z >> 4);
                $chunk = null;

                if(isset($chunks[$hash])){
                    $chunk = $chunks[$hash];
                }

                if($chunk !== null && $this->color){
                    $chunk->setBiomeColor($x, $z, 108, 151, 47);
                }

                for($y = $this->pos1->y; $y <= $this->pos2->y; $y++){
                    if($chunk !== null){
                        $id = $chunk->getBlockId($x, $y, $z);
                        $meta = $chunk->getBlockData($x, $y, $z);

                        switch($id){
                    
                            case 188:
                                $chunk->setBlock($x, $y, $z, Item::FENCE, 1);
                                break;
                            case 189:
                                $chunk->setBlock($x, $y, $z, Item::FENCE, 2);
                                break;
                            case 190:
                                $chunk->setBlock($x, $y, $z, Item::FENCE, 3);
                                break;
                            case 191:
                                $chunk->setBlock($x, $y, $z, Item::FENCE, 4);
                                break;
                            case 192:
                                $chunk->setBlock($x, $y, $z, Item::FENCE, 5);
                                break;
                               
                                        case 125:
                                            $chunk->setBlock($x, $y, $z, Item::DOUBLE_WOODEN_SLAB);
                                            break;
                                        case 126:
                                             $chunk->setBlock($x, $y, $z, Item::WOOD_SLAB, $meta);
                                            break;
                                        case 95:
                                             $chunk->setBlock($x, $y, $z, 241, $meta);
                                            break;
                                        case 160:
                                             $chunk->setBlock($x, $y, $z, Item::GLASS_PANE, $meta);
                                    
                                            break;
                                        case 166:
                                             $chunk->setBlock($x, $y, $z, Item::INVISIBLE_BEDROCK);
                                            break;
                    
                                        case 198:
                                             $chunk->setBlock($x, $y, $z, Item::END_ROD);
                                            break;
                                        case 199:
                                            $chunk->setBlock($x, $y, $z, Item::CHORUS_PLANT);
                                            break;
                                        case 202:
                                        case 204:
                                            $chunk->setBlock($x, $y, $z, Item::PURPUR_BLOCK);
                                            break;
                                        case 203:
                                             $chunk->setBlock($x, $y, $z, 202);
                                            break;
                                        case 208:
                                           $chunk->setBlock($x, $y, $z, Item::GRASS_PATH);
                                            break;
                                        case 210:
                                          $chunk->setBlock($x, $y, $z, 188);
                                            break;
                                        case 211:
                                           $chunk->setBlock($x, $y, $z, 189);
                                            break;
                                        case 158:
                                           $chunk->setBlock($x, $y, $z, 125);
                                            break;
                                        case 157:
                                           $chunk->setBlock($x, $y, $z, 126);
                                            break;
                                        case 235:
                                            $chunk->setBlock($x, $y, $z, 220);
                                            break;
                                        case 236:
                                            $chunk->setBlock($x, $y, $z, 221);
                                            break;
                                        case 237:
                                            $chunk->setBlock($x, $y, $z, 222);
                                            break;
                                        case 238:
                                           $chunk->setBlock($x, $y, $z, 223);
                                            break;
                                        case 239:
                                            $chunk->setBlock($x, $y, $z, 224);
                                            break;
                                        case 240:
                                            $chunk->setBlock($x, $y, $z, 225);
                                            break;
                                        case 241:
                                            $chunk->setBlock($x, $y, $z, 226);
                                            break;
                                        case 242:
                                            $chunk->setBlock($x, $y, $z, 227);
                                            break;
                                        case 243:
                                           $chunk->setBlock($x, $y, $z, 228);
                                            break;
                                        case 244:
                                            $chunk->setBlock($x, $y, $z, 229);
                                            break;
                                        case 245:
                                            $chunk->setBlock($x, $y, $z, 230);
                                            break;
                                        case 246:
                                            $chunk->setBlock($x, $y, $z, 231);
                                            break;
                                        case 247:
                                            $chunk->setBlock($x, $y, $z, 232);
                                            break;
                                        case 248:
                                           $chunk->setBlock($x, $y, $z, 233);
                                            break;
                                        case 249:
                                           $chunk->setBlock($x, $y, $z, 234);
                                            break;
                                        case 250:
                                           $chunk->setBlock($x, $y, $z, 235);
                                            break;
                                        case 251:
                                           $chunk->setBlock($x, $y, $z, 236);
                                            break;
                                        case 252:
                                            $chunk->setBlock($x, $y, $z, 237);
                                            break;
                                        case 218:
                                          $chunk->setBlock($x, $y, $z, 251);
                                            break;
                                        case 207:
                                           $chunk->setBlock($x, $y, $z, 244);
                                            break;
                        }
                    }
                }
            }
        }

        $this->setResult($chunks);
    }

    public function onCompletion(Server $server)
    {
        $chunks = $this->getResult();
        $level = $server->getLevel($this->levelId);
        if ($level != null) {
            foreach ($chunks as $hash => $chunk) {
                Level::getXZ($hash, $x, $z);
                $level->setChunk($x, $z, $chunk);
            }
        }
    }
}