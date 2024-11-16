<?php

/**
 * This file is part of BedrockProtocol.
 * Copyright (C) 2014-2022 PocketMine Team <https://github.com/pmmp/BedrockProtocol>
 *
 * BedrockProtocol is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol;

use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;

class UIDataPacket extends Packet {
	public const NETWORK_ID = ProtocolInfo::UI_DATA_PACKET;

	public string $formId;

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
