<?php

/*
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

class UIDataPacket extends DataPacket implements ClientboundPacket{
	public const NETWORK_ID = ProtocolInfo::UI_DATA_PACKET;

	public string $formId;

	public string $formData;

	/**
	 * @generate-create-func
	 */
	public static function create(string $formId, string $formData) : self{
		$result = new self;
		$result->formId = $formId;
		$result->formData = $formData;
		return $result;
	}

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

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleUIData($this);
	}
}
