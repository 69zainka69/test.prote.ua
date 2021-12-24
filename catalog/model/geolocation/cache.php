<?php

class ModelGeolocationCache extends Model
{
    public function get($id)
    {
        $cache = $this->db->query("SELECT * FROM `geolocation_cache` WHERE `id` = '$id'");
        if (empty($cache->row)) {
            return null;
        }
        
        $now = new DateTime('Europe/Kiev');

        if ($now->diff($cache->expiresAt > 0)) {
            $this->destroy($id);
            return null;
        } else {
            return $cache;
        }
    }

    public function set($id, $data, $day = null)
    {
        $cache = $this->get($id);
        $date = new DateTime();
        $expiresAt = $date->add(new DateInterval('P' . $day . 'D'));
        $expiresAt = date('Y-m-d H:i:s', $expiresAt->getTimestamp());
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        if (!$cache) {
            $this->db->query("INSERT INTO geolocation_cache (id, data, expiresAt, createdAt, updatedAt) VALUES ('$id', '$data', '$expiresAt', '$createdAt', '$updatedAt')");
        } else {
            return $this->db->query("UPDATE geolocation_cache SET expiresAt = $expiresAt, data = $data");
        }
    }

    public function destroy($id)
    {
        return $this->db->query("DELETE FROM geolocation_cache WHERE id = '$id'");
    }
}