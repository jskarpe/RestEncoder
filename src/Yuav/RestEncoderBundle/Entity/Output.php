<?php
namespace Yuav\RestEncoderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Output
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Output
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="outputs", cascade={"all"})
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity="MediaFile", inversedBy="output", cascade={"all"})
     */
    private $mediaFile;

    /**
     *
     * @var string @ORM\Column(name="type", type="string", length=2048)
     */
    private $type = 'standard';

    /**
     *
     * @var string @ORM\Column(name="label", type="string", length=2048, nullable=true)
     */
    private $label;

    /**
     *
     * @var string @ORM\Column(name="url", type="string", length=2048, nullable=true)
     */
    private $url;

    /**
     *
     * @var string @ORM\Column(name="secondaryUrl", type="string", length=2048, nullable=true)
     */
    private $secondaryUrl;

    /**
     *
     * @var string @ORM\Column(name="base_url", type="string", length=2048, nullable=true)
     */
    private $base_url;

    /**
     * @var string @ORM\Column(name="error_message", type="string", nullable=true)
     */
    private $errorMessage;
    
    /**
     * @var string @ORM\Column(name="error_type", type="string", length=255, nullable=true)
     */
    private $errorType;
    
    /**
     *
     * @var string @ORM\Column(name="current_event", type="string", length=100, nullable=true)
     */
    private $currentEvent = 'Queued';

    /**
     *
     * @var string @ORM\Column(name="current_event_progress", type="string", length=100)
     */
    private $currentEventProgress = 0;

    /**
     *
     * @var string @ORM\Column(name="progress", type="string", length=100, nullable=true)
     */
    private $progress;

    /**
     *
     * @var string @ORM\Column(name="filename", type="string", length=2048, nullable=true)
     */
    private $filename;

    /**
     *
     * @var string @ORM\Column(name="package_filename", type="string", length=2048, nullable=true)
     */
    private $package_filename;

    /**
     *
     * @var string @ORM\Column(name="package_format", type="string", length=2048, nullable=true)
     */
    private $package_format;

    /**
     *
     * @var string @ORM\Column(name="device_profile", type="string", length=2048, nullable=true)
     */
    private $device_profile;

    /**
     *
     * @var string @ORM\Column(name="strict", type="string", length=2048)
     */
    private $strict = false;

    /**
     *
     * @var string @ORM\Column(name="skip_video", type="string", length=2048)
     */
    private $skip_video = false;

    /**
     *
     * @var string @ORM\Column(name="skip_audio", type="string", length=2048)
     */
    private $skip_audio = false;

    /**
     *
     * @var string @ORM\Column(name="source", type="string", length=2048, nullable=true)
     */
    private $source;

    /**
     *
     * @var string @ORM\Column(name="credentials", type="string", length=2048, nullable=true)
     */
    private $credentials;

    /**
     *
     * @var string @ORM\Column(name="generate_md5_checksum", type="string", length=2048)
     */
    private $generate_md5_checksum = false;

    /**
     *
     * @var string @ORM\Column(name="parallel_upload_limit", type="string", length=2048)
     */
    private $parallel_upload_limit = 10;

    /**
     *
     * @var string @ORM\Column(name="headers", type="string", length=2048, nullable=true)
     */
    private $headers;

    /**
     * #####################
     * # Format and codecs #
     * #####################
     */
    
    /**
     *
     * @var string @ORM\Column(name="format", type="string", length=2048)
     */
    private $format = 'mp4';

    /**
     *
     * @var string @ORM\Column(name="video_codec", type="string", length=2048)
     */
    private $video_codec = 'h264';

    /**
     *
     * @var string @ORM\Column(name="audio_codec", type="string", length=2048)
     */
    private $audio_codec = 'aac';

    /**
     *
     * @var string @ORM\Column(name="size", type="string", length=2048, nullable=true)
     */
    private $size;

    /**
     *
     * @var string @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     *
     * @var string @ORM\Column(name="width", type="string", length=2048, nullable=true)
     */
    private $width;

    /**
     *
     * @var string @ORM\Column(name="height", type="string", length=2048, nullable=true)
     */
    private $height;

    /**
     *
     * @var string @ORM\Column(name="upscale", type="string", length=2048)
     */
    private $upscale = false;

    /**
     *
     * @var string @ORM\Column(name="aspect_mode", type="string", length=2048)
     */
    private $aspect_mode = 'preserve';

    /**
     *
     * @var string @ORM\Column(name="quality", type="string", length=2048)
     */
    private $quality = 3;

    /**
     *
     * @var string @ORM\Column(name="video_bitrate", type="string", length=2048, nullable=true)
     */
    private $video_bitrate;

    /**
     *
     * @var string @ORM\Column(name="audio_quality", type="string", length=2048)
     */
    private $audio_quality = 3;

    /**
     *
     * @var string @ORM\Column(name="audio_bitrate", type="string", length=2048, nullable=true)
     */
    private $audio_bitrate;

    /**
     *
     * @var string @ORM\Column(name="max_video_bitrate", type="string", length=2048, nullable=true)
     */
    private $max_video_bitrate;

    /**
     *
     * @var string @ORM\Column(name="speed", type="string", length=2048)
     */
    private $speed = 3;

    /**
     *
     * @var string @ORM\Column(name="decoder_bitrate_cap", type="string", length=2048, nullable=true)
     */
    private $decoder_bitrate_cap;

    /**
     *
     * @var string @ORM\Column(name="decoder_buffer_size", type="string", length=2048, nullable=true)
     */
    private $decoder_buffer_size;

    /**
     *
     * @var string @ORM\Column(name="one_pass", type="string", length=2048)
     */
    private $one_pass = false;

    /**
     *
     * @var string @ORM\Column(name="audio_constant_bitrate", type="string", length=2048)
     */
    private $audio_constant_bitrate = false;

    /**
     *
     * @var string @ORM\Column(name="frame_rate", type="string", length=2048, nullable=true)
     */
    private $frame_rate;

    /**
     *
     * @var string @ORM\Column(name="max_frame_rate", type="string", length=2048, nullable=true)
     */
    private $max_frame_rate;

    /**
     *
     * @var string @ORM\Column(name="decimate", type="string", length=2048, nullable=true)
     */
    private $decimate;

    /**
     *
     * @var string @ORM\Column(name="keyframe_interval", type="string", length=2048)
     */
    private $keyframe_interval = 250;

    /**
     *
     * @var string @ORM\Column(name="keyframe_rate", type="string", length=2048, nullable=true)
     */
    private $keyframe_rate;

    /**
     *
     * @var string @ORM\Column(name="fixed_keyframe_interval", type="string", length=2048)
     */
    private $fixed_keyframe_interval = false;

    /**
     *
     * @var string @ORM\Column(name="forced_keyframe_interval", type="string", length=2048, nullable=true)
     */
    private $forced_keyframe_interval;

    /**
     *
     * @var string @ORM\Column(name="forced_keyframe_rate", type="string", length=2048, nullable=true)
     */
    private $forced_keyframe_rate;

    /**
     *
     * @var string @ORM\Column(name="audio_sample_rate", type="string", length=2048, nullable=true)
     */
    private $audio_sample_rate;

    /**
     *
     * @var string @ORM\Column(name="audio_channels", type="string", length=2048)
     */
    private $audio_channels = 2;

    /**
     *
     *
     *
     * Start generating the thumbnails starting at the first frame.
     *
     * @var boolean @ORM\Column(name="start_at_first_frame", type="boolean")
     */
    private $start_at_first_frame = false;

    /**
     * Take thumbnails at an even interval, in seconds.
     *
     * @var string @ORM\Column(name="interval", type="integer", nullable=true)
     */
    private $interval;

    /**
     * Take thumbnails at an even interval, in frames.
     *
     * @var string @ORM\Column(name="interval_in_frames", type="integer", nullable=true)
     */
    private $interval_in_frames;

    /**
     * Prefix for thumbnail filenames.
     *
     * @var string @ORM\Column(name="prefix", type="string", length=256)
     */
    private $prefix = 'frame';

    /**
     *
     *
     *
     * Make the output publicly readable on S3.
     *
     * @var boolean @ORM\Column(name="public", type="boolean")
     */
    private $public = false;

    /**
     * An array of times, in seconds, at which to grab a thumbnail.
     *
     * @var string @ORM\Column(name="times", type="integer", nullable=true)
     */
    private $times;

    /**
     *
     * @var string @ORM\Column(name="access_control", type="string", length=2048, nullable=true)
     */
    private $access_control;

    /**
     *
     * @var string @ORM\Column(name="grantee", type="string", length=2048, nullable=true)
     */
    private $grantee;

    /**
     *
     * @var string @ORM\Column(name="permission", type="string", length=2048, nullable=true)
     */
    private $permission;

    /**
     *
     * @var string @ORM\Column(name="rrs", type="string", length=2048, nullable=true)
     */
    private $rrs;

    /**
     *
     * @var string @ORM\Column(name="watermarks", type="string", length=2048, nullable=true)
     */
    private $watermarks;

    /**
     *
     * @var string @ORM\Column(name="x", type="string", length=2048)
     */
    private $x = - 10;

    /**
     *
     * @var string @ORM\Column(name="y", type="string", length=2048)
     */
    private $y = - 10;

    /**
     *
     * @var string @ORM\Column(name="origin", type="string", length=2048)
     */
    private $origin = 'content';

    /**
     *
     * @var string @ORM\Column(name="opacity", type="string", length=2048)
     */
    private $opacity = 1.0;

    /**
     *
     * @var string @ORM\Column(name="caption_url", type="string", length=2048, nullable=true)
     */
    private $caption_url;

    /**
     *
     * @var string @ORM\Column(name="skip_captions", type="string", length=2048)
     */
    private $skip_captions = false;

    /**
     *
     * @var string @ORM\Column(name="rotate", type="string", length=2048)
     */
    private $rotate = 'auto';

    /**
     *
     * @var string @ORM\Column(name="deinterlace", type="string", length=2048)
     */
    private $deinterlace = 'detect';

    /**
     *
     * @var string @ORM\Column(name="sharpen", type="string", length=2048)
     */
    private $sharpen = false;

    /**
     *
     * @var string @ORM\Column(name="denoise", type="string", length=2048, nullable=true)
     */
    private $denoise;

    /**
     *
     * @var string @ORM\Column(name="autolevel", type="string", length=2048)
     */
    private $autolevel = false;

    /**
     *
     * @var string @ORM\Column(name="deblock", type="string", length=2048)
     */
    private $deblock = false;

    /**
     *
     * @var string @ORM\Column(name="audio_gain", type="string", length=2048, nullable=true)
     */
    private $audio_gain;

    /**
     *
     * @var string @ORM\Column(name="audio_normalize", type="boolean")
     */
    private $audio_normalize = false;

    /**
     *
     * @var string @ORM\Column(name="audio_pre_normalize", type="boolean")
     */
    private $audio_pre_normalize = false;

    /**
     *
     * @var string @ORM\Column(name="audio_post_normalize", type="boolean")
     */
    private $audio_post_normalize = false;

    /**
     *
     * @var string @ORM\Column(name="audio_bass", type="string", length=2048, nullable=true)
     */
    private $audio_bass;

    /**
     *
     * @var string @ORM\Column(name="audio_treble", type="string", length=2048, nullable=true)
     */
    private $audio_treble;

    /**
     *
     * @var string @ORM\Column(name="audio_highpass", type="string", length=2048, nullable=true)
     */
    private $audio_highpass;

    /**
     *
     * @var string @ORM\Column(name="audio_lowpass", type="string", length=2048, nullable=true)
     */
    private $audio_lowpass;

    /**
     *
     * @var string @ORM\Column(name="audio_compression_ratio", type="string", length=2048, nullable=true)
     */
    private $audio_compression_ratio;

    /**
     *
     * @var string @ORM\Column(name="audio_compression_threshold", type="smallint")
     */
    private $audio_compression_threshold = - 20;

    /**
     *
     * @var string @ORM\Column(name="audio_expansion_ratio", type="string", length=2048, nullable=true)
     */
    private $audio_expansion_ratio;

    /**
     *
     * @var string @ORM\Column(name="audio_expansion_threshold", type="smallint")
     */
    private $audio_expansion_threshold = - 35;

    /**
     *
     * @var string @ORM\Column(name="audio_fade", type="string", length=2048, nullable=true)
     */
    private $audio_fade;

    /**
     *
     * @var string @ORM\Column(name="audio_fade_in", type="string", length=2048, nullable=true)
     */
    private $audio_fade_in;

    /**
     *
     * @var string @ORM\Column(name="audio_fade_out", type="string", length=2048, nullable=true)
     */
    private $audio_fade_out;

    /**
     *
     * @var string @ORM\Column(name="audio_karaoke_mode", type="boolean")
     */
    private $audio_karaoke_mode = false;

    /**
     *
     * @var string @ORM\Column(name="start_clip", type="string", length=2048, nullable=true)
     */
    private $start_clip;

    /**
     *
     * @var string @ORM\Column(name="clip_length", type="string", length=2048, nullable=true)
     */
    private $clip_length;

    /**
     *
     * @var string @ORM\Column(name="notifications", type="string", length=2048, nullable=true)
     */
    private $notifications;

    /**
     *
     * @var string @ORM\Column(name="event", type="string", length=2048, nullable=true)
     */
    private $event;

    /**
     *
     * @var string @ORM\Column(name="min_size", type="string", length=2048, nullable=true)
     */
    private $min_size;

    /**
     *
     * @var string @ORM\Column(name="max_size", type="string", length=2048, nullable=true)
     */
    private $max_size;

    /**
     *
     * @var string @ORM\Column(name="min_duration", type="string", length=2048, nullable=true)
     */
    private $min_duration;

    /**
     *
     * @var string @ORM\Column(name="max_duration", type="string", length=2048, nullable=true)
     */
    private $max_duration;

    /**
     *
     * @var string @ORM\Column(name="segment_seconds", type="integer")
     */
    private $segment_seconds = 10;

    /**
     *
     * @var string @ORM\Column(name="segment_size", type="string", length=2048, nullable=true)
     */
    private $segment_size;

    /**
     *
     * @var string @ORM\Column(name="streams", type="string", length=2048, nullable=true)
     */
    private $streams;

    /**
     *
     * @var string @ORM\Column(name="path", type="string", length=2048, nullable=true)
     */
    private $path;

    /**
     *
     * @var string @ORM\Column(name="bandwidth", type="string", length=2048, nullable=true)
     */
    private $bandwidth;

    /**
     *
     * @var string @ORM\Column(name="resolution", type="string", length=2048, nullable=true)
     */
    private $resolution;

    /**
     *
     * @var string @ORM\Column(name="codecs", type="string", length=2048, nullable=true)
     */
    private $codecs;

    /**
     *
     * @var string @ORM\Column(name="segment_image_url", type="string", length=2048, nullable=true)
     */
    private $segment_image_url;

    /**
     *
     * @var string @ORM\Column(name="segment_video_snapshots", type="string", length=2048)
     */
    private $segment_video_snapshots = false;

    /**
     *
     * @var string @ORM\Column(name="max_hls_protocol_version", type="string", length=2048)
     */
    private $max_hls_protocol_version = 3;

    /**
     *
     * @var string @ORM\Column(name="hls_optimized_ts", type="string", length=2048)
     */
    private $hls_optimized_ts = true;

    /**
     *
     * @var string @ORM\Column(name="prepare_for_segmenting", type="string", length=2048, nullable=true)
     */
    private $prepare_for_segmenting;

    /**
     *
     * @var string @ORM\Column(name="instant_play", type="string", length=2048)
     */
    private $instant_play = false;

    /**
     *
     * @var string @ORM\Column(name="smil_base_url", type="string", length=2048, nullable=true)
     */
    private $smil_base_url;

    /**
     *
     * @var string @ORM\Column(name="encryption_method", type="string", length=2048, nullable=true)
     */
    private $encryption_method;

    /**
     *
     * @var string @ORM\Column(name="encryption_key", type="string", length=2048, nullable=true)
     */
    private $encryption_key;

    /**
     *
     * @var string @ORM\Column(name="encryption_key_url", type="string", length=2048, nullable=true)
     */
    private $encryption_key_url;

    /**
     *
     * @var string @ORM\Column(name="encryption_key_rotation_period", type="string", length=2048, nullable=true)
     */
    private $encryption_key_rotation_period;

    /**
     *
     * @var string @ORM\Column(name="encryption_key_url_prefix", type="string", length=2048, nullable=true)
     */
    private $encryption_key_url_prefix;

    /**
     *
     * @var string @ORM\Column(name="encryption_iv", type="string", length=2048, nullable=true)
     */
    private $encryption_iv;

    /**
     *
     * @var string @ORM\Column(name="encryption_password", type="string", length=2048, nullable=true)
     */
    private $encryption_password;

    /**
     *
     * @var string @ORM\Column(name="decryption_method", type="string", length=2048)
     */
    private $decryption_method = 'aes-128-cbc';

    /**
     *
     * @var string @ORM\Column(name="decryption_key", type="string", length=2048, nullable=true)
     */
    private $decryption_key;

    /**
     *
     * @var string @ORM\Column(name="decryption_key_url", type="string", length=2048, nullable=true)
     */
    private $decryption_key_url;

    /**
     *
     * @var string @ORM\Column(name="decryption_password", type="string", length=2048, nullable=true)
     */
    private $decryption_password;

    /**
     *
     * @var string @ORM\Column(name="h264_reference_frames", type="integer")
     */
    private $h264_reference_frames = 3;

    /**
     *
     * @var string @ORM\Column(name="h264_profile", type="string", length=2048)
     */
    private $h264_profile = 'baseline';

    /**
     *
     * @var string @ORM\Column(name="h264_level", type="string", length=2048)
     */
    private $h264_level = 'auto';

    /**
     *
     * @var string @ORM\Column(name="h264_bframes", type="string", length=2048)
     */
    private $h264_bframes = 0;

    /**
     *
     * @var string @ORM\Column(name="tuning", type="string", length=2048, nullable=true)
     */
    private $tuning;

    /**
     *
     * @var string @ORM\Column(name="crf", type="string", length=2048, nullable=true)
     */
    private $crf;

    /**
     *
     * @var string @ORM\Column(name="cue_points", type="string", length=2048, nullable=true)
     */
    private $cue_points;

    /**
     *
     * @var string @ORM\Column(name="time", type="string", length=2048, nullable=true)
     */
    private $time;

    /**
     *
     * @var string @ORM\Column(name="name", type="string", length=2048, nullable=true)
     */
    private $name;

    /**
     *
     * @var string @ORM\Column(name="data", type="string", length=2048, nullable=true)
     */
    private $data;

    /**
     *
     * @var string @ORM\Column(name="vp6_temporal_down_watermark", type="integer")
     */
    private $vp6_temporal_down_watermark = 20;

    /**
     *
     * @var string @ORM\Column(name="vp6_temporal_resampling", type="boolean")
     */
    private $vp6_temporal_resampling = true;

    /**
     *
     * @var string @ORM\Column(name="vp6_undershoot_pct", type="integer")
     */
    private $vp6_undershoot_pct = 90;

    /**
     *
     * @var string @ORM\Column(name="vp6_profile", type="string", length=2048)
     */
    private $vp6_profile = 'vp6e';

    /**
     *
     * @var string @ORM\Column(name="vp6_compression_mode", type="string", length=2048)
     */
    private $vp6_compression_mode = 'good';

    /**
     *
     * @var string @ORM\Column(name="vp6_2pass_min_section", type="string", length=2048)
     */
    private $vp6_2pass_min_section = 40;

    /**
     *
     * @var string @ORM\Column(name="vp6_2pass_max_section", type="string", length=2048)
     */
    private $vp6_2pass_max_section = 400;

    /**
     *
     * @var string @ORM\Column(name="vp6_stream_prebuffer", type="string", length=2048)
     */
    private $vp6_stream_prebuffer = 6;

    /**
     *
     * @var string @ORM\Column(name="vp6_stream_max_buffer", type="string", length=2048, nullable=true)
     */
    private $vp6_stream_max_buffer;

    /**
     *
     * @var string @ORM\Column(name="vp6_deinterlace_mode", type="string", length=2048)
     */
    private $vp6_deinterlace_mode = 'adaptive';

    /**
     *
     * @var string @ORM\Column(name="vp6_denoise_level", type="string", length=2048)
     */
    private $vp6_denoise_level = 0;

    /**
     *
     * @var string @ORM\Column(name="alpha_transparency", type="boolean")
     */
    private $alpha_transparency = false;

    /**
     *
     * @var string @ORM\Column(name="constant_bitrate", type="boolean")
     */
    private $constant_bitrate = false;

    /**
     *
     * @var string @ORM\Column(name="hint", type="boolean")
     */
    private $hint = false;

    /**
     *
     * @var string @ORM\Column(name="mtu_size", type="integer")
     */
    private $mtu_size = 1450;

    /**
     *
     * @var string @ORM\Column(name="max_aac_profile", type="string", length=2048)
     */
    private $max_aac_profile = 'he-aac';

    /**
     *
     * @var string @ORM\Column(name="force_aac_profile", type="string", length=2048, nullable=true)
     */
    private $force_aac_profile;

    /**
     *
     * @var string @ORM\Column(name="aspera_transfer_policy", type="string", length=2048)
     */
    private $aspera_transfer_policy = 'fair';

    /**
     *
     * @var string @ORM\Column(name="transfer_minimum_rate", type="string", length=2048)
     */
    private $transfer_minimum_rate = 1000;

    /**
     *
     * @var string @ORM\Column(name="transfer_maximum_rate", type="string", length=2048)
     */
    private $transfer_maximum_rate = 250000;

    /**
     *
     * @var string @ORM\Column(name="copy_video", type="boolean")
     */
    private $copy_video = false;

    /**
     *
     * @var string @ORM\Column(name="copy_audio", type="boolean")
     */
    private $copy_audio = false;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type            
     * @return Output
     */
    public function setType($type)
    {
        if (null === $type) {
            throw new \InvalidArgumentException("Type should not be null");
        }
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set label
     *
     * @param string $label            
     * @return Output
     */
    public function setLabel($label)
    {
        $this->label = $label;
        
        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set url
     *
     * @param string $url            
     * @return Output
     */
    public function setUrl($url)
    {
        $this->url = $url;
        
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set secondaryUrl
     *
     * @param string $secondaryUrl            
     * @return Output
     */
    public function setSecondaryUrl($secondaryUrl)
    {
        $this->secondaryUrl = $secondaryUrl;
        
        return $this;
    }

    /**
     * Get secondaryUrl
     *
     * @return string
     */
    public function getSecondaryUrl()
    {
        return $this->secondaryUrl;
    }

    /**
     * Set base_url
     *
     * @param string $baseUrl            
     * @return Output
     */
    public function setBaseUrl($baseUrl)
    {
        $this->base_url = $baseUrl;
        
        return $this;
    }

    /**
     * Get base_url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * Set filename
     *
     * @param string $filename            
     * @return Output
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        
        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set package_filename
     *
     * @param string $packageFilename            
     * @return Output
     */
    public function setPackageFilename($packageFilename)
    {
        $this->package_filename = $packageFilename;
        
        return $this;
    }

    /**
     * Get package_filename
     *
     * @return string
     */
    public function getPackageFilename()
    {
        return $this->package_filename;
    }

    /**
     * Set package_format
     *
     * @param string $packageFormat            
     * @return Output
     */
    public function setPackageFormat($packageFormat)
    {
        $this->package_format = $packageFormat;
        
        return $this;
    }

    /**
     * Get package_format
     *
     * @return string
     */
    public function getPackageFormat()
    {
        return $this->package_format;
    }

    /**
     * Set device_profile
     *
     * @param string $deviceProfile            
     * @return Output
     */
    public function setDeviceProfile($deviceProfile)
    {
        $this->device_profile = $deviceProfile;
        
        return $this;
    }

    /**
     * Get device_profile
     *
     * @return string
     */
    public function getDeviceProfile()
    {
        return $this->device_profile;
    }

    /**
     * Set strict
     *
     * @param string $strict            
     * @return Output
     */
    public function setStrict($strict)
    {
        $this->strict = $strict;
        
        return $this;
    }

    /**
     * Get strict
     *
     * @return string
     */
    public function getStrict()
    {
        return $this->strict;
    }

    /**
     * Set skip_video
     *
     * @param string $skipVideo            
     * @return Output
     */
    public function setSkipVideo($skipVideo)
    {
        $this->skip_video = $skipVideo;
        
        return $this;
    }

    /**
     * Get skip_video
     *
     * @return string
     */
    public function getSkipVideo()
    {
        return $this->skip_video;
    }

    /**
     * Set skip_audio
     *
     * @param string $skipAudio            
     * @return Output
     */
    public function setSkipAudio($skipAudio)
    {
        $this->skip_audio = $skipAudio;
        
        return $this;
    }

    /**
     * Get skip_audio
     *
     * @return string
     */
    public function getSkipAudio()
    {
        return $this->skip_audio;
    }

    /**
     * Set source
     *
     * @param string $source            
     * @return Output
     */
    public function setSource($source)
    {
        $this->source = $source;
        
        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set credentials
     *
     * @param string $credentials            
     * @return Output
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        
        return $this;
    }

    /**
     * Get credentials
     *
     * @return string
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set generate_md5_checksum
     *
     * @param string $generateMd5Checksum            
     * @return Output
     */
    public function setGenerateMd5Checksum($generateMd5Checksum)
    {
        $this->generate_md5_checksum = $generateMd5Checksum;
        
        return $this;
    }

    /**
     * Get generate_md5_checksum
     *
     * @return string
     */
    public function getGenerateMd5Checksum()
    {
        return $this->generate_md5_checksum;
    }

    /**
     * Set parallel_upload_limit
     *
     * @param string $parallelUploadLimit            
     * @return Output
     */
    public function setParallelUploadLimit($parallelUploadLimit)
    {
        $this->parallel_upload_limit = $parallelUploadLimit;
        
        return $this;
    }

    /**
     * Get parallel_upload_limit
     *
     * @return string
     */
    public function getParallelUploadLimit()
    {
        return $this->parallel_upload_limit;
    }

    /**
     * Set headers
     *
     * @param string $headers            
     * @return Output
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        
        return $this;
    }

    /**
     * Get headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set format
     *
     * @param string $format            
     * @return Output
     */
    public function setFormat($format)
    {
        $this->format = $format;
        
        return $this;
    }

    /**
     * Get format
     *
     * Defaulted by the output filename and then video or audio codec.
     * Otherwise: mp4 (for standard outputs); ts (for segmented outputs).
     *
     * @return string
     */
    public function getFormat()
    {
        if (null === $this->format) {
            $outputFilename = $this->getFilename();
            switch (pathinfo($outputFilename, PATHINFO_EXTENSION)) {
                case 'webm':
                    $this->format = 'webm';
                    break;
                case 'mp4':
                default:
                    $this->format = 'mp4';
                    break;
            }
        }
        return $this->format;
    }

    /**
     * Set video_codec
     *
     * @param string $videoCodec            
     * @return Output
     */
    public function setVideoCodec($videoCodec)
    {
        $this->video_codec = $videoCodec;
        
        return $this;
    }

    /**
     * Get video_codec
     *
     * Defaultet by the format, profile, or audio_codec. h264 if none are provided.
     *
     * @return string
     */
    public function getVideoCodec()
    {
        if (null === $this->video_codec) {
            switch ($this->getFormat()) {
                case 'webm':
                    $this->video_codec = 'vp8';
                    break;
                case 'mp4':
                default:
                    $this->video_codec = 'h264';
            }
        }
        return $this->video_codec;
    }

    /**
     * Set audio_codec
     *
     * @param string $audioCodec            
     * @return Output
     */
    public function setAudioCodec($audioCodec)
    {
        $this->audio_codec = $audioCodec;
        
        return $this;
    }

    /**
     * Get audio_codec
     *
     * Determined by the format, profile, or video_codec. aac if none are provided.
     *
     * @return string
     */
    public function getAudioCodec()
    {
        if (null === $this->audio_codec) {
            switch ($this->getFormat()) {
                case 'mp4':
                default:
                    $this->audio_codec = 'aac';
            }
        }
        return $this->audio_codec;
    }

    /**
     * Set size
     *
     * @param string $size            
     * @return Output
     */
    public function setSize($size)
    {
        $this->size = $size;
        
        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set width
     *
     * @param string $width            
     * @return Output
     */
    public function setWidth($width)
    {
        $this->width = $width;
        
        return $this;
    }

    /**
     * Get width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param string $height            
     * @return Output
     */
    public function setHeight($height)
    {
        $this->height = $height;
        
        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set upscale
     *
     * @param string $upscale            
     * @return Output
     */
    public function setUpscale($upscale)
    {
        $this->upscale = $upscale;
        
        return $this;
    }

    /**
     * Get upscale
     *
     * @return string
     */
    public function getUpscale()
    {
        return $this->upscale;
    }

    /**
     * Set aspect_mode
     *
     * @param string $aspectMode            
     * @return Output
     */
    public function setAspectMode($aspectMode)
    {
        $this->aspect_mode = $aspectMode;
        
        return $this;
    }

    /**
     * Get aspect_mode
     *
     * @return string
     */
    public function getAspectMode()
    {
        return $this->aspect_mode;
    }

    /**
     * Set quality
     *
     * @param string $quality            
     * @return Output
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
        
        return $this;
    }

    /**
     * Get quality
     *
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set video_bitrate
     *
     * @param string $videoBitrate            
     * @return Output
     */
    public function setVideoBitrate($videoBitrate)
    {
        $this->video_bitrate = $videoBitrate;
        
        return $this;
    }

    /**
     * Get video_bitrate
     *
     * @return string
     */
    public function getVideoBitrate()
    {
        return $this->video_bitrate;
    }

    /**
     * Set audio_quality
     *
     * @param string $audioQuality            
     * @return Output
     */
    public function setAudioQuality($audioQuality)
    {
        $this->audio_quality = $audioQuality;
        
        return $this;
    }

    /**
     * Get audio_quality
     *
     * @return string
     */
    public function getAudioQuality()
    {
        return $this->audio_quality;
    }

    /**
     * Set audio_bitrate
     *
     * @param string $audioBitrate            
     * @return Output
     */
    public function setAudioBitrate($audioBitrate)
    {
        $this->audio_bitrate = $audioBitrate;
        
        return $this;
    }

    /**
     * Get audio_bitrate
     *
     * @return string
     */
    public function getAudioBitrate()
    {
        return $this->audio_bitrate;
    }

    /**
     * Set max_video_bitrate
     *
     * @param string $maxVideoBitrate            
     * @return Output
     */
    public function setMaxVideoBitrate($maxVideoBitrate)
    {
        $this->max_video_bitrate = $maxVideoBitrate;
        
        return $this;
    }

    /**
     * Get max_video_bitrate
     *
     * @return string
     */
    public function getMaxVideoBitrate()
    {
        return $this->max_video_bitrate;
    }

    /**
     * Set speed
     *
     * @param string $speed            
     * @return Output
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        
        return $this;
    }

    /**
     * Get speed
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set decoder_bitrate_cap
     *
     * @param string $decoderBitrateCap            
     * @return Output
     */
    public function setDecoderBitrateCap($decoderBitrateCap)
    {
        $this->decoder_bitrate_cap = $decoderBitrateCap;
        
        return $this;
    }

    /**
     * Get decoder_bitrate_cap
     *
     * @return string
     */
    public function getDecoderBitrateCap()
    {
        return $this->decoder_bitrate_cap;
    }

    /**
     * Set decoder_buffer_size
     *
     * @param string $decoderBufferSize            
     * @return Output
     */
    public function setDecoderBufferSize($decoderBufferSize)
    {
        $this->decoder_buffer_size = $decoderBufferSize;
        
        return $this;
    }

    /**
     * Get decoder_buffer_size
     *
     * @return string
     */
    public function getDecoderBufferSize()
    {
        return $this->decoder_buffer_size;
    }

    /**
     * Set one_pass
     *
     * @param string $onePass            
     * @return Output
     */
    public function setOnePass($onePass)
    {
        $this->one_pass = $onePass;
        
        return $this;
    }

    /**
     * Get one_pass
     *
     * @return string
     */
    public function getOnePass()
    {
        return $this->one_pass;
    }

    /**
     * Set audio_constant_bitrate
     *
     * @param string $audioConstantBitrate            
     * @return Output
     */
    public function setAudioConstantBitrate($audioConstantBitrate)
    {
        $this->audio_constant_bitrate = $audioConstantBitrate;
        
        return $this;
    }

    /**
     * Get audio_constant_bitrate
     *
     * @return string
     */
    public function getAudioConstantBitrate()
    {
        return $this->audio_constant_bitrate;
    }

    /**
     * Set frame_rate
     *
     * @param string $frameRate            
     * @return Output
     */
    public function setFrameRate($frameRate)
    {
        $this->frame_rate = $frameRate;
        
        return $this;
    }

    /**
     * Get frame_rate
     *
     * @return string
     */
    public function getFrameRate()
    {
        return $this->frame_rate;
    }

    /**
     * Set max_frame_rate
     *
     * @param string $maxFrameRate            
     * @return Output
     */
    public function setMaxFrameRate($maxFrameRate)
    {
        $this->max_frame_rate = $maxFrameRate;
        
        return $this;
    }

    /**
     * Get max_frame_rate
     *
     * @return string
     */
    public function getMaxFrameRate()
    {
        return $this->max_frame_rate;
    }

    /**
     * Set decimate
     *
     * @param string $decimate            
     * @return Output
     */
    public function setDecimate($decimate)
    {
        $this->decimate = $decimate;
        
        return $this;
    }

    /**
     * Get decimate
     *
     * @return string
     */
    public function getDecimate()
    {
        return $this->decimate;
    }

    /**
     * Set keyframe_interval
     *
     * @param string $keyframeInterval            
     * @return Output
     */
    public function setKeyframeInterval($keyframeInterval)
    {
        $this->keyframe_interval = $keyframeInterval;
        
        return $this;
    }

    /**
     * Get keyframe_interval
     *
     * @return string
     */
    public function getKeyframeInterval()
    {
        return $this->keyframe_interval;
    }

    /**
     * Set keyframe_rate
     *
     * @param string $keyframeRate            
     * @return Output
     */
    public function setKeyframeRate($keyframeRate)
    {
        $this->keyframe_rate = $keyframeRate;
        
        return $this;
    }

    /**
     * Get keyframe_rate
     *
     * @return string
     */
    public function getKeyframeRate()
    {
        return $this->keyframe_rate;
    }

    /**
     * Set fixed_keyframe_interval
     *
     * @param string $fixedKeyframeInterval            
     * @return Output
     */
    public function setFixedKeyframeInterval($fixedKeyframeInterval)
    {
        $this->fixed_keyframe_interval = $fixedKeyframeInterval;
        
        return $this;
    }

    /**
     * Get fixed_keyframe_interval
     *
     * @return string
     */
    public function getFixedKeyframeInterval()
    {
        return $this->fixed_keyframe_interval;
    }

    /**
     * Set forced_keyframe_interval
     *
     * @param string $forcedKeyframeInterval            
     * @return Output
     */
    public function setForcedKeyframeInterval($forcedKeyframeInterval)
    {
        $this->forced_keyframe_interval = $forcedKeyframeInterval;
        
        return $this;
    }

    /**
     * Get forced_keyframe_interval
     *
     * @return string
     */
    public function getForcedKeyframeInterval()
    {
        return $this->forced_keyframe_interval;
    }

    /**
     * Set forced_keyframe_rate
     *
     * @param string $forcedKeyframeRate            
     * @return Output
     */
    public function setForcedKeyframeRate($forcedKeyframeRate)
    {
        $this->forced_keyframe_rate = $forcedKeyframeRate;
        
        return $this;
    }

    /**
     * Get forced_keyframe_rate
     *
     * @return string
     */
    public function getForcedKeyframeRate()
    {
        return $this->forced_keyframe_rate;
    }

    /**
     * Set audio_sample_rate
     *
     * @param string $audioSampleRate            
     * @return Output
     */
    public function setAudioSampleRate($audioSampleRate)
    {
        $this->audio_sample_rate = $audioSampleRate;
        
        return $this;
    }

    /**
     * Get audio_sample_rate
     *
     * @return string
     */
    public function getAudioSampleRate()
    {
        return $this->audio_sample_rate;
    }

    /**
     * Set audio_channels
     *
     * @param string $audioChannels            
     * @return Output
     */
    public function setAudioChannels($audioChannels)
    {
        $this->audio_channels = $audioChannels;
        
        return $this;
    }

    /**
     * Get audio_channels
     *
     * @return string
     */
    public function getAudioChannels()
    {
        return $this->audio_channels;
    }

    /**
     * Set number
     *
     * @param string $number            
     * @return Output
     */
    public function setNumber($number)
    {
        $this->number = $number;
        
        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set start_at_first_frame
     *
     * @param string $startAtFirstFrame            
     * @return Output
     */
    public function setStartAtFirstFrame($startAtFirstFrame)
    {
        $this->start_at_first_frame = $startAtFirstFrame;
        
        return $this;
    }

    /**
     * Get start_at_first_frame
     *
     * @return string
     */
    public function getStartAtFirstFrame()
    {
        return $this->start_at_first_frame;
    }

    /**
     * Set interval
     *
     * @param string $interval            
     * @return Output
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        
        return $this;
    }

    /**
     * Get interval
     *
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set interval_in_frames
     *
     * @param string $intervalInFrames            
     * @return Output
     */
    public function setIntervalInFrames($intervalInFrames)
    {
        $this->interval_in_frames = $intervalInFrames;
        
        return $this;
    }

    /**
     * Get interval_in_frames
     *
     * @return string
     */
    public function getIntervalInFrames()
    {
        return $this->interval_in_frames;
    }

    /**
     * Set times
     *
     * @param string $times            
     * @return Output
     */
    public function setTimes($times)
    {
        $this->times = $times;
        
        return $this;
    }

    /**
     * Get times
     *
     * @return string
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * Set prefix
     *
     * @param string $prefix            
     * @return Output
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        
        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set public
     *
     * @param string $public            
     * @return Output
     */
    public function setPublic($public)
    {
        $this->public = $public;
        
        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set access_control
     *
     * @param string $accessControl            
     * @return Output
     */
    public function setAccessControl($accessControl)
    {
        $this->access_control = $accessControl;
        
        return $this;
    }

    /**
     * Get access_control
     *
     * @return string
     */
    public function getAccessControl()
    {
        return $this->access_control;
    }

    /**
     * Set grantee
     *
     * @param string $grantee            
     * @return Output
     */
    public function setGrantee($grantee)
    {
        $this->grantee = $grantee;
        
        return $this;
    }

    /**
     * Get grantee
     *
     * @return string
     */
    public function getGrantee()
    {
        return $this->grantee;
    }

    /**
     * Set permission
     *
     * @param string $permission            
     * @return Output
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
        
        return $this;
    }

    /**
     * Get permission
     *
     * @return string
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set rrs
     *
     * @param string $rrs            
     * @return Output
     */
    public function setRrs($rrs)
    {
        $this->rrs = $rrs;
        
        return $this;
    }

    /**
     * Get rrs
     *
     * @return string
     */
    public function getRrs()
    {
        return $this->rrs;
    }

    /**
     * Set watermarks
     *
     * @param string $watermarks            
     * @return Output
     */
    public function setWatermarks($watermarks)
    {
        $this->watermarks = $watermarks;
        
        return $this;
    }

    /**
     * Get watermarks
     *
     * @return string
     */
    public function getWatermarks()
    {
        return $this->watermarks;
    }

    /**
     * Set x
     *
     * @param string $x            
     * @return Output
     */
    public function setX($x)
    {
        $this->x = $x;
        
        return $this;
    }

    /**
     * Get x
     *
     * @return string
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param string $y            
     * @return Output
     */
    public function setY($y)
    {
        $this->y = $y;
        
        return $this;
    }

    /**
     * Get y
     *
     * @return string
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set origin
     *
     * @param string $origin            
     * @return Output
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        
        return $this;
    }

    /**
     * Get origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set opacity
     *
     * @param string $opacity            
     * @return Output
     */
    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;
        
        return $this;
    }

    /**
     * Get opacity
     *
     * @return string
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set caption_url
     *
     * @param string $captionUrl            
     * @return Output
     */
    public function setCaptionUrl($captionUrl)
    {
        $this->caption_url = $captionUrl;
        
        return $this;
    }

    /**
     * Get caption_url
     *
     * @return string
     */
    public function getCaptionUrl()
    {
        return $this->caption_url;
    }

    /**
     * Set skip_captions
     *
     * @param string $skipCaptions            
     * @return Output
     */
    public function setSkipCaptions($skipCaptions)
    {
        $this->skip_captions = $skipCaptions;
        
        return $this;
    }

    /**
     * Get skip_captions
     *
     * @return string
     */
    public function getSkipCaptions()
    {
        return $this->skip_captions;
    }

    /**
     * Set rotate
     *
     * @param string $rotate            
     * @return Output
     */
    public function setRotate($rotate)
    {
        $this->rotate = $rotate;
        
        return $this;
    }

    /**
     * Get rotate
     *
     * @return string
     */
    public function getRotate()
    {
        return $this->rotate;
    }

    /**
     * Set deinterlace
     *
     * @param string $deinterlace            
     * @return Output
     */
    public function setDeinterlace($deinterlace)
    {
        $this->deinterlace = $deinterlace;
        
        return $this;
    }

    /**
     * Get deinterlace
     *
     * @return string
     */
    public function getDeinterlace()
    {
        return $this->deinterlace;
    }

    /**
     * Set sharpen
     *
     * @param string $sharpen            
     * @return Output
     */
    public function setSharpen($sharpen)
    {
        $this->sharpen = $sharpen;
        
        return $this;
    }

    /**
     * Get sharpen
     *
     * @return string
     */
    public function getSharpen()
    {
        return $this->sharpen;
    }

    /**
     * Set denoise
     *
     * @param string $denoise            
     * @return Output
     */
    public function setDenoise($denoise)
    {
        $this->denoise = $denoise;
        
        return $this;
    }

    /**
     * Get denoise
     *
     * @return string
     */
    public function getDenoise()
    {
        return $this->denoise;
    }

    /**
     * Set autolevel
     *
     * @param string $autolevel            
     * @return Output
     */
    public function setAutolevel($autolevel)
    {
        $this->autolevel = $autolevel;
        
        return $this;
    }

    /**
     * Get autolevel
     *
     * @return string
     */
    public function getAutolevel()
    {
        return $this->autolevel;
    }

    /**
     * Set deblock
     *
     * @param string $deblock            
     * @return Output
     */
    public function setDeblock($deblock)
    {
        $this->deblock = $deblock;
        
        return $this;
    }

    /**
     * Get deblock
     *
     * @return string
     */
    public function getDeblock()
    {
        return $this->deblock;
    }

    /**
     * Set audio_gain
     *
     * @param string $audioGain            
     * @return Output
     */
    public function setAudioGain($audioGain)
    {
        $this->audio_gain = $audioGain;
        
        return $this;
    }

    /**
     * Get audio_gain
     *
     * @return string
     */
    public function getAudioGain()
    {
        return $this->audio_gain;
    }

    /**
     * Set audio_normalize
     *
     * @param string $audioNormalize            
     * @return Output
     */
    public function setAudioNormalize($audioNormalize)
    {
        $this->audio_normalize = $audioNormalize;
        
        return $this;
    }

    /**
     * Get audio_normalize
     *
     * @return string
     */
    public function getAudioNormalize()
    {
        return $this->audio_normalize;
    }

    /**
     * Set audio_pre_normalize
     *
     * @param string $audioPreNormalize            
     * @return Output
     */
    public function setAudioPreNormalize($audioPreNormalize)
    {
        $this->audio_pre_normalize = $audioPreNormalize;
        
        return $this;
    }

    /**
     * Get audio_pre_normalize
     *
     * @return string
     */
    public function getAudioPreNormalize()
    {
        return $this->audio_pre_normalize;
    }

    /**
     * Set audio_post_normalize
     *
     * @param string $audioPostNormalize            
     * @return Output
     */
    public function setAudioPostNormalize($audioPostNormalize)
    {
        $this->audio_post_normalize = $audioPostNormalize;
        
        return $this;
    }

    /**
     * Get audio_post_normalize
     *
     * @return string
     */
    public function getAudioPostNormalize()
    {
        return $this->audio_post_normalize;
    }

    /**
     * Set audio_bass
     *
     * @param string $audioBass            
     * @return Output
     */
    public function setAudioBass($audioBass)
    {
        $this->audio_bass = $audioBass;
        
        return $this;
    }

    /**
     * Get audio_bass
     *
     * @return string
     */
    public function getAudioBass()
    {
        return $this->audio_bass;
    }

    /**
     * Set audio_treble
     *
     * @param string $audioTreble            
     * @return Output
     */
    public function setAudioTreble($audioTreble)
    {
        $this->audio_treble = $audioTreble;
        
        return $this;
    }

    /**
     * Get audio_treble
     *
     * @return string
     */
    public function getAudioTreble()
    {
        return $this->audio_treble;
    }

    /**
     * Set audio_highpass
     *
     * @param string $audioHighpass            
     * @return Output
     */
    public function setAudioHighpass($audioHighpass)
    {
        $this->audio_highpass = $audioHighpass;
        
        return $this;
    }

    /**
     * Get audio_highpass
     *
     * @return string
     */
    public function getAudioHighpass()
    {
        return $this->audio_highpass;
    }

    /**
     * Set audio_lowpass
     *
     * @param string $audioLowpass            
     * @return Output
     */
    public function setAudioLowpass($audioLowpass)
    {
        $this->audio_lowpass = $audioLowpass;
        
        return $this;
    }

    /**
     * Get audio_lowpass
     *
     * @return string
     */
    public function getAudioLowpass()
    {
        return $this->audio_lowpass;
    }

    /**
     * Set audio_compression_ratio
     *
     * @param string $audioCompressionRatio            
     * @return Output
     */
    public function setAudioCompressionRatio($audioCompressionRatio)
    {
        $this->audio_compression_ratio = $audioCompressionRatio;
        
        return $this;
    }

    /**
     * Get audio_compression_ratio
     *
     * @return string
     */
    public function getAudioCompressionRatio()
    {
        return $this->audio_compression_ratio;
    }

    /**
     * Set audio_compression_threshold
     *
     * @param string $audioCompressionThreshold            
     * @return Output
     */
    public function setAudioCompressionThreshold($audioCompressionThreshold)
    {
        $this->audio_compression_threshold = $audioCompressionThreshold;
        
        return $this;
    }

    /**
     * Get audio_compression_threshold
     *
     * @return string
     */
    public function getAudioCompressionThreshold()
    {
        return $this->audio_compression_threshold;
    }

    /**
     * Set audio_expansion_ratio
     *
     * @param string $audioExpansionRatio            
     * @return Output
     */
    public function setAudioExpansionRatio($audioExpansionRatio)
    {
        $this->audio_expansion_ratio = $audioExpansionRatio;
        
        return $this;
    }

    /**
     * Get audio_expansion_ratio
     *
     * @return string
     */
    public function getAudioExpansionRatio()
    {
        return $this->audio_expansion_ratio;
    }

    /**
     * Set audio_expansion_threshold
     *
     * @param string $audioExpansionThreshold            
     * @return Output
     */
    public function setAudioExpansionThreshold($audioExpansionThreshold)
    {
        $this->audio_expansion_threshold = $audioExpansionThreshold;
        
        return $this;
    }

    /**
     * Get audio_expansion_threshold
     *
     * @return string
     */
    public function getAudioExpansionThreshold()
    {
        return $this->audio_expansion_threshold;
    }

    /**
     * Set audio_fade
     *
     * @param string $audioFade            
     * @return Output
     */
    public function setAudioFade($audioFade)
    {
        $this->audio_fade = $audioFade;
        
        return $this;
    }

    /**
     * Get audio_fade
     *
     * @return string
     */
    public function getAudioFade()
    {
        return $this->audio_fade;
    }

    /**
     * Set audio_fade_in
     *
     * @param string $audioFadeIn            
     * @return Output
     */
    public function setAudioFadeIn($audioFadeIn)
    {
        $this->audio_fade_in = $audioFadeIn;
        
        return $this;
    }

    /**
     * Get audio_fade_in
     *
     * @return string
     */
    public function getAudioFadeIn()
    {
        return $this->audio_fade_in;
    }

    /**
     * Set audio_fade_out
     *
     * @param string $audioFadeOut            
     * @return Output
     */
    public function setAudioFadeOut($audioFadeOut)
    {
        $this->audio_fade_out = $audioFadeOut;
        
        return $this;
    }

    /**
     * Get audio_fade_out
     *
     * @return string
     */
    public function getAudioFadeOut()
    {
        return $this->audio_fade_out;
    }

    /**
     * Set audio_karaoke_mode
     *
     * @param string $audioKaraokeMode            
     * @return Output
     */
    public function setAudioKaraokeMode($audioKaraokeMode)
    {
        $this->audio_karaoke_mode = $audioKaraokeMode;
        
        return $this;
    }

    /**
     * Get audio_karaoke_mode
     *
     * @return string
     */
    public function getAudioKaraokeMode()
    {
        return $this->audio_karaoke_mode;
    }

    /**
     * Set start_clip
     *
     * @param string $startClip            
     * @return Output
     */
    public function setStartClip($startClip)
    {
        $this->start_clip = $startClip;
        
        return $this;
    }

    /**
     * Get start_clip
     *
     * @return string
     */
    public function getStartClip()
    {
        return $this->start_clip;
    }

    /**
     * Set clip_length
     *
     * @param string $clipLength            
     * @return Output
     */
    public function setClipLength($clipLength)
    {
        $this->clip_length = $clipLength;
        
        return $this;
    }

    /**
     * Get clip_length
     *
     * @return string
     */
    public function getClipLength()
    {
        return $this->clip_length;
    }

    /**
     * Set notifications
     *
     * @param string $notifications            
     * @return Output
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
        
        return $this;
    }

    /**
     * Get notifications
     *
     * @return string
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Set event
     *
     * @param string $event            
     * @return Output
     */
    public function setEvent($event)
    {
        $this->event = $event;
        
        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set min_size
     *
     * @param string $minSize            
     * @return Output
     */
    public function setMinSize($minSize)
    {
        $this->min_size = $minSize;
        
        return $this;
    }

    /**
     * Get min_size
     *
     * @return string
     */
    public function getMinSize()
    {
        return $this->min_size;
    }

    /**
     * Set max_size
     *
     * @param string $maxSize            
     * @return Output
     */
    public function setMaxSize($maxSize)
    {
        $this->max_size = $maxSize;
        
        return $this;
    }

    /**
     * Get max_size
     *
     * @return string
     */
    public function getMaxSize()
    {
        return $this->max_size;
    }

    /**
     * Set min_duration
     *
     * @param string $minDuration            
     * @return Output
     */
    public function setMinDuration($minDuration)
    {
        $this->min_duration = $minDuration;
        
        return $this;
    }

    /**
     * Get min_duration
     *
     * @return string
     */
    public function getMinDuration()
    {
        return $this->min_duration;
    }

    /**
     * Set max_duration
     *
     * @param string $maxDuration            
     * @return Output
     */
    public function setMaxDuration($maxDuration)
    {
        $this->max_duration = $maxDuration;
        
        return $this;
    }

    /**
     * Get max_duration
     *
     * @return string
     */
    public function getMaxDuration()
    {
        return $this->max_duration;
    }

    /**
     * Set segment_seconds
     *
     * @param string $segmentSeconds            
     * @return Output
     */
    public function setSegmentSeconds($segmentSeconds)
    {
        $this->segment_seconds = $segmentSeconds;
        
        return $this;
    }

    /**
     * Get segment_seconds
     *
     * @return string
     */
    public function getSegmentSeconds()
    {
        return $this->segment_seconds;
    }

    /**
     * Set segment_size
     *
     * @param string $segmentSize            
     * @return Output
     */
    public function setSegmentSize($segmentSize)
    {
        $this->segment_size = $segmentSize;
        
        return $this;
    }

    /**
     * Get segment_size
     *
     * @return string
     */
    public function getSegmentSize()
    {
        return $this->segment_size;
    }

    /**
     * Set streams
     *
     * @param string $streams            
     * @return Output
     */
    public function setStreams($streams)
    {
        $this->streams = $streams;
        
        return $this;
    }

    /**
     * Get streams
     *
     * @return string
     */
    public function getStreams()
    {
        return $this->streams;
    }

    /**
     * Set path
     *
     * @param string $path            
     * @return Output
     */
    public function setPath($path)
    {
        $this->path = $path;
        
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set bandwidth
     *
     * @param string $bandwidth            
     * @return Output
     */
    public function setBandwidth($bandwidth)
    {
        $this->bandwidth = $bandwidth;
        
        return $this;
    }

    /**
     * Get bandwidth
     *
     * @return string
     */
    public function getBandwidth()
    {
        return $this->bandwidth;
    }

    /**
     * Set resolution
     *
     * @param string $resolution            
     * @return Output
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
        
        return $this;
    }

    /**
     * Get resolution
     *
     * @return string
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set codecs
     *
     * @param string $codecs            
     * @return Output
     */
    public function setCodecs($codecs)
    {
        $this->codecs = $codecs;
        
        return $this;
    }

    /**
     * Get codecs
     *
     * @return string
     */
    public function getCodecs()
    {
        return $this->codecs;
    }

    /**
     * Set segment_image_url
     *
     * @param string $segmentImageUrl            
     * @return Output
     */
    public function setSegmentImageUrl($segmentImageUrl)
    {
        $this->segment_image_url = $segmentImageUrl;
        
        return $this;
    }

    /**
     * Get segment_image_url
     *
     * @return string
     */
    public function getSegmentImageUrl()
    {
        return $this->segment_image_url;
    }

    /**
     * Set segment_video_snapshots
     *
     * @param string $segmentVideoSnapshots            
     * @return Output
     */
    public function setSegmentVideoSnapshots($segmentVideoSnapshots)
    {
        $this->segment_video_snapshots = $segmentVideoSnapshots;
        
        return $this;
    }

    /**
     * Get segment_video_snapshots
     *
     * @return string
     */
    public function getSegmentVideoSnapshots()
    {
        return $this->segment_video_snapshots;
    }

    /**
     * Set max_hls_protocol_version
     *
     * @param string $maxHlsProtocolVersion            
     * @return Output
     */
    public function setMaxHlsProtocolVersion($maxHlsProtocolVersion)
    {
        $this->max_hls_protocol_version = $maxHlsProtocolVersion;
        
        return $this;
    }

    /**
     * Get max_hls_protocol_version
     *
     * @return string
     */
    public function getMaxHlsProtocolVersion()
    {
        return $this->max_hls_protocol_version;
    }

    /**
     * Set hls_optimized_ts
     *
     * @param string $hlsOptimizedTs            
     * @return Output
     */
    public function setHlsOptimizedTs($hlsOptimizedTs)
    {
        $this->hls_optimized_ts = $hlsOptimizedTs;
        
        return $this;
    }

    /**
     * Get hls_optimized_ts
     *
     * @return string
     */
    public function getHlsOptimizedTs()
    {
        return $this->hls_optimized_ts;
    }

    /**
     * Set prepare_for_segmenting
     *
     * @param string $prepareForSegmenting            
     * @return Output
     */
    public function setPrepareForSegmenting($prepareForSegmenting)
    {
        $this->prepare_for_segmenting = $prepareForSegmenting;
        
        return $this;
    }

    /**
     * Get prepare_for_segmenting
     *
     * @return string
     */
    public function getPrepareForSegmenting()
    {
        return $this->prepare_for_segmenting;
    }

    /**
     * Set instant_play
     *
     * @param string $instantPlay            
     * @return Output
     */
    public function setInstantPlay($instantPlay)
    {
        $this->instant_play = $instantPlay;
        
        return $this;
    }

    /**
     * Get instant_play
     *
     * @return string
     */
    public function getInstantPlay()
    {
        return $this->instant_play;
    }

    /**
     * Set smil_base_url
     *
     * @param string $smilBaseUrl            
     * @return Output
     */
    public function setSmilBaseUrl($smilBaseUrl)
    {
        $this->smil_base_url = $smilBaseUrl;
        
        return $this;
    }

    /**
     * Get smil_base_url
     *
     * @return string
     */
    public function getSmilBaseUrl()
    {
        return $this->smil_base_url;
    }

    /**
     * Set encryption_method
     *
     * @param string $encryptionMethod            
     * @return Output
     */
    public function setEncryptionMethod($encryptionMethod)
    {
        $this->encryption_method = $encryptionMethod;
        
        return $this;
    }

    /**
     * Get encryption_method
     *
     * @return string
     */
    public function getEncryptionMethod()
    {
        return $this->encryption_method;
    }

    /**
     * Set encryption_key
     *
     * @param string $encryptionKey            
     * @return Output
     */
    public function setEncryptionKey($encryptionKey)
    {
        $this->encryption_key = $encryptionKey;
        
        return $this;
    }

    /**
     * Get encryption_key
     *
     * @return string
     */
    public function getEncryptionKey()
    {
        return $this->encryption_key;
    }

    /**
     * Set encryption_key_url
     *
     * @param string $encryptionKeyUrl            
     * @return Output
     */
    public function setEncryptionKeyUrl($encryptionKeyUrl)
    {
        $this->encryption_key_url = $encryptionKeyUrl;
        
        return $this;
    }

    /**
     * Get encryption_key_url
     *
     * @return string
     */
    public function getEncryptionKeyUrl()
    {
        return $this->encryption_key_url;
    }

    /**
     * Set encryption_key_rotation_period
     *
     * @param string $encryptionKeyRotationPeriod            
     * @return Output
     */
    public function setEncryptionKeyRotationPeriod($encryptionKeyRotationPeriod)
    {
        $this->encryption_key_rotation_period = $encryptionKeyRotationPeriod;
        
        return $this;
    }

    /**
     * Get encryption_key_rotation_period
     *
     * @return string
     */
    public function getEncryptionKeyRotationPeriod()
    {
        return $this->encryption_key_rotation_period;
    }

    /**
     * Set encryption_key_url_prefix
     *
     * @param string $encryptionKeyUrlPrefix            
     * @return Output
     */
    public function setEncryptionKeyUrlPrefix($encryptionKeyUrlPrefix)
    {
        $this->encryption_key_url_prefix = $encryptionKeyUrlPrefix;
        
        return $this;
    }

    /**
     * Get encryption_key_url_prefix
     *
     * @return string
     */
    public function getEncryptionKeyUrlPrefix()
    {
        return $this->encryption_key_url_prefix;
    }

    /**
     * Set encryption_iv
     *
     * @param string $encryptionIv            
     * @return Output
     */
    public function setEncryptionIv($encryptionIv)
    {
        $this->encryption_iv = $encryptionIv;
        
        return $this;
    }

    /**
     * Get encryption_iv
     *
     * @return string
     */
    public function getEncryptionIv()
    {
        return $this->encryption_iv;
    }

    /**
     * Set encryption_password
     *
     * @param string $encryptionPassword            
     * @return Output
     */
    public function setEncryptionPassword($encryptionPassword)
    {
        $this->encryption_password = $encryptionPassword;
        
        return $this;
    }

    /**
     * Get encryption_password
     *
     * @return string
     */
    public function getEncryptionPassword()
    {
        return $this->encryption_password;
    }

    /**
     * Set decryption_method
     *
     * @param string $decryptionMethod            
     * @return Output
     */
    public function setDecryptionMethod($decryptionMethod)
    {
        $this->decryption_method = $decryptionMethod;
        
        return $this;
    }

    /**
     * Get decryption_method
     *
     * @return string
     */
    public function getDecryptionMethod()
    {
        return $this->decryption_method;
    }

    /**
     * Set decryption_key
     *
     * @param string $decryptionKey            
     * @return Output
     */
    public function setDecryptionKey($decryptionKey)
    {
        $this->decryption_key = $decryptionKey;
        
        return $this;
    }

    /**
     * Get decryption_key
     *
     * @return string
     */
    public function getDecryptionKey()
    {
        return $this->decryption_key;
    }

    /**
     * Set decryption_key_url
     *
     * @param string $decryptionKeyUrl            
     * @return Output
     */
    public function setDecryptionKeyUrl($decryptionKeyUrl)
    {
        $this->decryption_key_url = $decryptionKeyUrl;
        
        return $this;
    }

    /**
     * Get decryption_key_url
     *
     * @return string
     */
    public function getDecryptionKeyUrl()
    {
        return $this->decryption_key_url;
    }

    /**
     * Set decryption_password
     *
     * @param string $decryptionPassword            
     * @return Output
     */
    public function setDecryptionPassword($decryptionPassword)
    {
        $this->decryption_password = $decryptionPassword;
        
        return $this;
    }

    /**
     * Get decryption_password
     *
     * @return string
     */
    public function getDecryptionPassword()
    {
        return $this->decryption_password;
    }

    /**
     * Set h264_reference_frames
     *
     * @param string $h264ReferenceFrames            
     * @return Output
     */
    public function setH264ReferenceFrames($h264ReferenceFrames)
    {
        $this->h264_reference_frames = $h264ReferenceFrames;
        
        return $this;
    }

    /**
     * Get h264_reference_frames
     *
     * @return string
     */
    public function getH264ReferenceFrames()
    {
        return $this->h264_reference_frames;
    }

    /**
     * Set h264_profile
     *
     * @param string $h264Profile            
     * @return Output
     */
    public function setH264Profile($h264Profile)
    {
        $this->h264_profile = $h264Profile;
        
        return $this;
    }

    /**
     * Get h264_profile
     *
     * @return string
     */
    public function getH264Profile()
    {
        return $this->h264_profile;
    }

    /**
     * Set h264_level
     *
     * @param string $h264Level            
     * @return Output
     */
    public function setH264Level($h264Level)
    {
        $this->h264_level = $h264Level;
        
        return $this;
    }

    /**
     * Get h264_level
     *
     * @return string
     */
    public function getH264Level()
    {
        return $this->h264_level;
    }

    /**
     * Set h264_bframes
     *
     * @param string $h264Bframes            
     * @return Output
     */
    public function setH264Bframes($h264Bframes)
    {
        $this->h264_bframes = $h264Bframes;
        
        return $this;
    }

    /**
     * Get h264_bframes
     *
     * @return string
     */
    public function getH264Bframes()
    {
        return $this->h264_bframes;
    }

    /**
     * Set tuning
     *
     * @param string $tuning            
     * @return Output
     */
    public function setTuning($tuning)
    {
        $this->tuning = $tuning;
        
        return $this;
    }

    /**
     * Get tuning
     *
     * @return string
     */
    public function getTuning()
    {
        return $this->tuning;
    }

    /**
     * Set crf
     *
     * @param string $crf            
     * @return Output
     */
    public function setCrf($crf)
    {
        $this->crf = $crf;
        
        return $this;
    }

    /**
     * Get crf
     *
     * @return string
     */
    public function getCrf()
    {
        return $this->crf;
    }

    /**
     * Set cue_points
     *
     * @param string $cuePoints            
     * @return Output
     */
    public function setCuePoints($cuePoints)
    {
        $this->cue_points = $cuePoints;
        
        return $this;
    }

    /**
     * Get cue_points
     *
     * @return string
     */
    public function getCuePoints()
    {
        return $this->cue_points;
    }

    /**
     * Set time
     *
     * @param string $time            
     * @return Output
     */
    public function setTime($time)
    {
        $this->time = $time;
        
        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set name
     *
     * @param string $name            
     * @return Output
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set data
     *
     * @param string $data            
     * @return Output
     */
    public function setData($data)
    {
        $this->data = $data;
        
        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set vp6_temporal_down_watermark
     *
     * @param string $vp6TemporalDownWatermark            
     * @return Output
     */
    public function setVp6TemporalDownWatermark($vp6TemporalDownWatermark)
    {
        $this->vp6_temporal_down_watermark = $vp6TemporalDownWatermark;
        
        return $this;
    }

    /**
     * Get vp6_temporal_down_watermark
     *
     * @return string
     */
    public function getVp6TemporalDownWatermark()
    {
        return $this->vp6_temporal_down_watermark;
    }

    /**
     * Set vp6_temporal_resampling
     *
     * @param string $vp6TemporalResampling            
     * @return Output
     */
    public function setVp6TemporalResampling($vp6TemporalResampling)
    {
        $this->vp6_temporal_resampling = $vp6TemporalResampling;
        
        return $this;
    }

    /**
     * Get vp6_temporal_resampling
     *
     * @return string
     */
    public function getVp6TemporalResampling()
    {
        return $this->vp6_temporal_resampling;
    }

    /**
     * Set vp6_undershoot_pct
     *
     * @param string $vp6UndershootPct            
     * @return Output
     */
    public function setVp6UndershootPct($vp6UndershootPct)
    {
        $this->vp6_undershoot_pct = $vp6UndershootPct;
        
        return $this;
    }

    /**
     * Get vp6_undershoot_pct
     *
     * @return string
     */
    public function getVp6UndershootPct()
    {
        return $this->vp6_undershoot_pct;
    }

    /**
     * Set vp6_profile
     *
     * @param string $vp6Profile            
     * @return Output
     */
    public function setVp6Profile($vp6Profile)
    {
        $this->vp6_profile = $vp6Profile;
        
        return $this;
    }

    /**
     * Get vp6_profile
     *
     * @return string
     */
    public function getVp6Profile()
    {
        return $this->vp6_profile;
    }

    /**
     * Set vp6_compression_mode
     *
     * @param string $vp6CompressionMode            
     * @return Output
     */
    public function setVp6CompressionMode($vp6CompressionMode)
    {
        $this->vp6_compression_mode = $vp6CompressionMode;
        
        return $this;
    }

    /**
     * Get vp6_compression_mode
     *
     * @return string
     */
    public function getVp6CompressionMode()
    {
        return $this->vp6_compression_mode;
    }

    /**
     * Set vp6_2pass_min_section
     *
     * @param string $vp62passMinSection            
     * @return Output
     */
    public function setVp62passMinSection($vp62passMinSection)
    {
        $this->vp6_2pass_min_section = $vp62passMinSection;
        
        return $this;
    }

    /**
     * Get vp6_2pass_min_section
     *
     * @return string
     */
    public function getVp62passMinSection()
    {
        return $this->vp6_2pass_min_section;
    }

    /**
     * Set vp6_2pass_max_section
     *
     * @param string $vp62passMaxSection            
     * @return Output
     */
    public function setVp62passMaxSection($vp62passMaxSection)
    {
        $this->vp6_2pass_max_section = $vp62passMaxSection;
        
        return $this;
    }

    /**
     * Get vp6_2pass_max_section
     *
     * @return string
     */
    public function getVp62passMaxSection()
    {
        return $this->vp6_2pass_max_section;
    }

    /**
     * Set vp6_stream_prebuffer
     *
     * @param string $vp6StreamPrebuffer            
     * @return Output
     */
    public function setVp6StreamPrebuffer($vp6StreamPrebuffer)
    {
        $this->vp6_stream_prebuffer = $vp6StreamPrebuffer;
        
        return $this;
    }

    /**
     * Get vp6_stream_prebuffer
     *
     * @return string
     */
    public function getVp6StreamPrebuffer()
    {
        return $this->vp6_stream_prebuffer;
    }

    /**
     * Set vp6_stream_max_buffer
     *
     * @param string $vp6StreamMaxBuffer            
     * @return Output
     */
    public function setVp6StreamMaxBuffer($vp6StreamMaxBuffer)
    {
        $this->vp6_stream_max_buffer = $vp6StreamMaxBuffer;
        
        return $this;
    }

    /**
     * Get vp6_stream_max_buffer
     *
     * @return string
     */
    public function getVp6StreamMaxBuffer()
    {
        return $this->vp6_stream_max_buffer;
    }

    /**
     * Set vp6_deinterlace_mode
     *
     * @param string $vp6DeinterlaceMode            
     * @return Output
     */
    public function setVp6DeinterlaceMode($vp6DeinterlaceMode)
    {
        $this->vp6_deinterlace_mode = $vp6DeinterlaceMode;
        
        return $this;
    }

    /**
     * Get vp6_deinterlace_mode
     *
     * @return string
     */
    public function getVp6DeinterlaceMode()
    {
        return $this->vp6_deinterlace_mode;
    }

    /**
     * Set vp6_denoise_level
     *
     * @param string $vp6DenoiseLevel            
     * @return Output
     */
    public function setVp6DenoiseLevel($vp6DenoiseLevel)
    {
        $this->vp6_denoise_level = $vp6DenoiseLevel;
        
        return $this;
    }

    /**
     * Get vp6_denoise_level
     *
     * @return string
     */
    public function getVp6DenoiseLevel()
    {
        return $this->vp6_denoise_level;
    }

    /**
     * Set alpha_transparency
     *
     * @param string $alphaTransparency            
     * @return Output
     */
    public function setAlphaTransparency($alphaTransparency)
    {
        $this->alpha_transparency = $alphaTransparency;
        
        return $this;
    }

    /**
     * Get alpha_transparency
     *
     * @return string
     */
    public function getAlphaTransparency()
    {
        return $this->alpha_transparency;
    }

    /**
     * Set constant_bitrate
     *
     * @param string $constantBitrate            
     * @return Output
     */
    public function setConstantBitrate($constantBitrate)
    {
        $this->constant_bitrate = $constantBitrate;
        
        return $this;
    }

    /**
     * Get constant_bitrate
     *
     * @return string
     */
    public function getConstantBitrate()
    {
        return $this->constant_bitrate;
    }

    /**
     * Set hint
     *
     * @param string $hint            
     * @return Output
     */
    public function setHint($hint)
    {
        $this->hint = $hint;
        
        return $this;
    }

    /**
     * Get hint
     *
     * @return string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Set mtu_size
     *
     * @param string $mtuSize            
     * @return Output
     */
    public function setMtuSize($mtuSize)
    {
        $this->mtu_size = $mtuSize;
        
        return $this;
    }

    /**
     * Get mtu_size
     *
     * @return string
     */
    public function getMtuSize()
    {
        return $this->mtu_size;
    }

    /**
     * Set max_aac_profile
     *
     * @param string $maxAacProfile            
     * @return Output
     */
    public function setMaxAacProfile($maxAacProfile)
    {
        $this->max_aac_profile = $maxAacProfile;
        
        return $this;
    }

    /**
     * Get max_aac_profile
     *
     * @return string
     */
    public function getMaxAacProfile()
    {
        return $this->max_aac_profile;
    }

    /**
     * Set force_aac_profile
     *
     * @param string $forceAacProfile            
     * @return Output
     */
    public function setForceAacProfile($forceAacProfile)
    {
        $this->force_aac_profile = $forceAacProfile;
        
        return $this;
    }

    /**
     * Get force_aac_profile
     *
     * @return string
     */
    public function getForceAacProfile()
    {
        return $this->force_aac_profile;
    }

    /**
     * Set aspera_transfer_policy
     *
     * @param string $asperaTransferPolicy            
     * @return Output
     */
    public function setAsperaTransferPolicy($asperaTransferPolicy)
    {
        $this->aspera_transfer_policy = $asperaTransferPolicy;
        
        return $this;
    }

    /**
     * Get aspera_transfer_policy
     *
     * @return string
     */
    public function getAsperaTransferPolicy()
    {
        return $this->aspera_transfer_policy;
    }

    /**
     * Set transfer_minimum_rate
     *
     * @param string $transferMinimumRate            
     * @return Output
     */
    public function setTransferMinimumRate($transferMinimumRate)
    {
        $this->transfer_minimum_rate = $transferMinimumRate;
        
        return $this;
    }

    /**
     * Get transfer_minimum_rate
     *
     * @return string
     */
    public function getTransferMinimumRate()
    {
        return $this->transfer_minimum_rate;
    }

    /**
     * Set transfer_maximum_rate
     *
     * @param string $transferMaximumRate            
     * @return Output
     */
    public function setTransferMaximumRate($transferMaximumRate)
    {
        $this->transfer_maximum_rate = $transferMaximumRate;
        
        return $this;
    }

    /**
     * Get transfer_maximum_rate
     *
     * @return string
     */
    public function getTransferMaximumRate()
    {
        return $this->transfer_maximum_rate;
    }

    /**
     * Set copy_video
     *
     * @param string $copyVideo            
     * @return Output
     */
    public function setCopyVideo($copyVideo)
    {
        $this->copy_video = $copyVideo;
        
        return $this;
    }

    /**
     * Get copy_video
     *
     * @return string
     */
    public function getCopyVideo()
    {
        return $this->copy_video;
    }

    /**
     * Set copy_audio
     *
     * @param string $copyAudio            
     * @return Output
     */
    public function setCopyAudio($copyAudio)
    {
        $this->copy_audio = $copyAudio;
        
        return $this;
    }

    /**
     * Get copy_audio
     *
     * @return string
     */
    public function getCopyAudio()
    {
        return $this->copy_audio;
    }

    /**
     *
     * @return Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     *
     * @param Job $job            
     */
    public function setJob(Job $job)
    {
        $this->job = $job;
        return $this;
    }

    public function getCurrentEvent()
    {
        return $this->currentEvent;
    }

    public function setCurrentEvent($currentEvent)
    {
        $this->currentEvent = $currentEvent;
        return $this;
    }

    public function getCurrentEventProgress()
    {
        return $this->currentEventProgress;
    }

    public function setCurrentEventProgress($currentEventProgress)
    {
        $this->currentEventProgress = $currentEventProgress;
        return $this;
    }

    public function getProgress()
    {
        if (null === $this->progress) {
            $this->calculateProgress();
        }
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
        return $this;
    }

    public function getMediaFile()
    {
        return $this->mediaFile;
    }

    public function setMediaFile($mediaFile)
    {
        $this->mediaFile = $mediaFile;
        return $this;
    }
    
    /**
     * Helper function to calculate overall progress
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function calculateProgress()
    {
        $weights = array(
            'Encoding' => 0.90,
            'Uploading' => 0.10
        );
    
        $progress = 0;
        $e = $this->getCurrentEvent();
        $ep = $this->getCurrentEventProgress() / 100;
        switch ($this->getCurrentEvent()) {
            default:
                break;
            case 'Encoding':
                $progress = $ep * $weights[$e];
                break;
            case 'Uploading':
                $progress = $weights['Encoding'] + $ep * $weights[$e];
        }
        $this->progress = $progress * 100;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function getErrorType()
    {
        return $this->errorType;
    }

    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
        return $this;
    }
	
}
