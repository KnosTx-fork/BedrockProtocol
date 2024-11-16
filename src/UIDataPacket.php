<?php

namespace pocketmine\network\mcpe\protocol;

use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;

class UIDataPacket extends Packet {
	public const NETWORK_ID = ProtocolInfo::UI_DATA_PACKET;

	/** @var string */
	public string $formId;

	/** @var string */
	public string $formData;

	/** 
     * Decode payload from client packet
     */
	protected function decodePayload(PacketSerializer $in) : void {
		$this->formId = $in->getString();
		$this->formData = $in->getString();
	}

	/**
     * Encode payload to send packet
	 */
	protected function encodePayload(PacketSerializer $out) : void {
		$out->putString($this->formId);
		$out->putString($this->formData);
	}

	/**
	 * Get the network ID of the packet
	 */	
	public function getNetworkId() : int{
		return self::NETWORK_ID;
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handlePlayerAction($this);
	}
}
